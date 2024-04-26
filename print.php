<?php
require("fpdf/fpdf.php");
require("word.php");
require("config.php");

// Customer and invoice details
$info = [
    "customer" => "",
    "address" => "",
    "city" => "",
    "invoice_no" => "",
    "invoice_date" => "",
    "total_amt" => "",
    "words" => "",
];

// Validate and sanitize input
$id = isset($_GET["id"]) ? $_GET["id"] : null;
if (!is_numeric($id)) {
    die("Invalid input");
}

// Select Invoice Details From Database
$sql = "SELECT * FROM invoice WHERE SID=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();

    // Assuming IndianCurrency class is defined in word.php
    $obj = new IndianCurrency($row["GRAND_TOTAL"]);

    $info = [
        "customer" => $row["CNAME"],
        "address" => $row["CADDRESS"],
        "city" => $row["CCITY"],
        "invoice_no" => $row["INVOICE_NO"],
        "invoice_date" => date("d-m-Y", strtotime($row["INVOICE_DATE"])),
        "total_amt" => $row["GRAND_TOTAL"],
        "words" => $obj->get_words(),
    ];
} else {
    die("No invoice found");
}

// Invoice Products
$products_info = [];

// Select Invoice Product Details From Database
$sql = "SELECT * FROM invoice_products WHERE SID=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    die("Error executing query: " . $stmt->error);
}
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $counter = 1; // Counter variable for serial numbers
    while ($row = $res->fetch_assoc()) {
        $products_info[] = [
            "sr_no" => $counter++,
            "name" => $row["PNAME"],
            "price" => $row["PRICE"],
            "qty" => $row["QTY"],
            "total" => $row["TOTAL"],
        ];
    }
}

class PDF extends FPDF
{
    function Header()
    {
        // Display Company Info
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(50, 6, "# SEASON #", 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->Cell(50, 7, "Agashenagar, Shrirampur,", 0, 1);
        $this->Cell(50, 7, "Maharashtra 413709, India.", 0, 1);
        $this->Cell(50, 7, "Mobile No.: +91 8766854678 ", 0, 1);
        $this->Cell(50, 7, "Email Address: pratikabhang.in@gmail.com ", 0, 1);

        // Display INVOICE text
        $this->SetY(18);
        $this->SetX(-50);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(60, 10, "  INVOICE / BILL", 1, 2);

        // Display Horizontal line
        $this->Line(0, 48, 210, 48);
    }

    function body($info, $products_info)
    {
        // Billing Details
        $this->SetY(55);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(50, 7, "To: ", 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->Cell(50, 7, $info["customer"], 0, 1);
        $this->Cell(50, 7, $info["address"], 0, 1);
        $this->Cell(50, 7, $info["city"], 0, 1);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0,10,"ITEMS",0,1,"C");
        // Display Invoice no
        $this->SetY(55);
        $this->SetX(-65);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(50, 7, "Invoice No : " . $info["invoice_no"]);

        // Display Invoice date
        $this->SetY(63);
        $this->SetX(-65);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(50, 7, "Invoice Date : " . $info["invoice_date"]);
        // Display Table headings
        
        $this->SetY(95);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(20, 9, "Sr. No.", 1, 0, "C"); // Add Serial Number column
        $this->Cell(80, 9, "DESCRIPTION", 1, 0, "C");
        $this->Cell(30, 9, "PRICE", 1, 0, "C");
        $this->Cell(20, 9, "QTY", 1, 0, "C");
        $this->Cell(40, 9, "TOTAL", 1, 1, "C");
        $this->SetFont('Arial', '', 12);

        // Display table product rows
        foreach ($products_info as $row) {
            $this->Cell(20, 9, $row["sr_no"], 1, 0, "C"); // Display serial number
            $this->Cell(80, 9, $row["name"], 1, 0);
            $this->Cell(30, 9, $row["price"], 1, 0, "C");
            $this->Cell(20, 9, $row["qty"], 1, 0, "C");
            $this->Cell(40, 9, $row["total"], 1, 1, "C");
        }

        // Display table total row with space
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(150, 9, "TOTAL AMOUNT", 1, 0, "C");
        $this->Cell(40, 9, $info["total_amt"], 1, 1, "C");

        // Move to display amount in words
        $this->SetY($this->GetY() + 10);
        $this->SetX(10);
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(0, 0, "Total Amount in Words:  " . $info["words"], 0, 0, "C");
       

    }

    function Footer()
    {
         $this->SetY(-70);

      $this->Ln(15);
      $this->SetFont('Arial','',10);
$this->Cell(0, 4, "Terms & Conditions", 0, 1, "L");
$this->Cell(0, 4, "Refund: 7 days with receipt. Unused, original packaging", 0, 1, "L");
$this->Cell(0, 4, "Replacement: 5 days with receipt. Defective items.", 0, 1, "L");
$this->Cell(0, 4, "Warranty: Refer to manufacturer. Coverage varies", 0, 1, "L");
$this->Cell(0, 4, "We reserve right to refuse. Policies may change.", 0, 1, "L"); 
$this->Cell(0, 4, "For inquiries, contact customer service.", 0, 1, "L");
$this->Cell(0, 4, "Thank you for shopping.", 0, 1, "L");


  
      //set footer position
      $this->SetY(-50);

      $this->Ln(15);
      $this->SetFont('Arial','',12);
      $this->Image('stamp.png', 165, $this->GetY() - 30, 30, );
      $this->Cell(0,8,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',6);
       $this->Cell(0,2,"From SEASON                      ",0,1,"R");
    
        // Set footer position
        $this->SetY(-15);

        // Page number
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');

        // Separator line
        $this->Line(10, $this->GetY() + 2, 200, $this->GetY() + 2);

    }
}

// Create A4 Page with Portrait
$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$pdf->body($info, $products_info);
$pdf->Output();
?>