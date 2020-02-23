<?php
//link : https://www.webslesson.info/2016/05/how-to-make-simple-pagination-using-php-mysql.html

$connect = mysqli_connect("localhost", "root", "", "demo_pagination");
$record_per_page = 5;
$page = '';
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $record_per_page;

$query = "SELECT * FROM tbl_student order by student_id DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Webslesson Tutorial | PHP Pagination with Next Previous First Last page Link</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <style>
            a {
                padding:8px 16px;
                border:1px solid #ccc;
                color:#333;
                font-weight:bold;
            }
        </style>
    </head>
    <body>
        <br /><br />
        <div class="container">
            <h3 align="center">PHP Pagination with Next Previous First Last page Link</h3><br />
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Student Contact number</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row["student_id"]; ?></td>
                            <td><?php echo $row["student_name"]; ?></td>
                            <td><?php echo $row["student_phone"]; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <div align="center">
                    <br />
                    <?php
                    $page_query = "SELECT * FROM tbl_student ORDER BY student_id DESC";
                    $page_result = mysqli_query($connect, $page_query);
                    $total_records = mysqli_num_rows($page_result);
                    $total_pages = ceil($total_records / $record_per_page);
                    $start_loop = $page;
                    $difference = $total_pages - $page;
                    if ($difference <= 5) {
                        $start_loop = $total_pages - 5;
                    }
                    $end_loop = $start_loop + 4;
                    if ($page > 1) {
                        echo "<a href='index.php?page=1'>First</a>";
                        echo "<a href='index.php?page=" . ($page - 1) . "'><<</a>";
                    }
                    for ($i = $start_loop; $i <= $end_loop; $i++) {
                        echo "<a href='index.php?page=" . $i . "'>" . $i . "</a>";
                    }
                    if ($page <= $end_loop) {
                        echo "<a href='index.php?page=" . ($page + 1) . "'>>></a>";
                        echo "<a href='index.php?page=" . $total_pages . "'>Last</a>";
                    }
                    ?>
                </div>
                <br /><br />
            </div>
        </div>
    </body>
</html>

<!--
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(250) NOT NULL,
  `student_phone` varchar(20) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

INSERT INTO `tbl_student` (`student_id`, `student_name`, `student_phone`) VALUES
(1, 'Pauline S. Rich', '412-735-0224'),
(2, 'Sarah C. White', '320-552-9961'),
(3, 'Samuel L. Leslie', '201-324-8264'),
(4, 'Norma R. Manly', '478-322-4715'),
(5, 'Kimberly R. Castro', '479-966-6788'),
(6, 'Elaine R. Davis', '701-685-8912'),
(7, 'Concepcion S. Gardner', '607-829-8758'),
(8, 'Patricia J. White', '803-789-0429'),
(9, 'Michael M. Bothwell', '214-585-0737'),
(10, 'Ronald C. Vansickle', '630-571-4107'),
(11, 'Clarence A. Rich', '904-459-3747'),
(12, 'Elizabeth W. Peterson', '404-380-9481'),
(13, 'Renee R. Hewitt', '323-350-4973'),
(14, 'John K. Love', '337-229-1983'),
(15, 'Teresa J. Rincon', '216-394-6894'),
(16, 'Erin S. Huckaby', '503-284-8652'),
(17, 'Brian A. Handley', '989-304-7122'),
(18, 'Michelle A. Polk', '540-232-0351'),
(19, 'Wanda M. Brown', '718-262-7466'),
(20, 'Phillip A. Hatcher', '407-492-5727'),
(21, 'Dennis J. Terrell', '903-863-5810'),
(22, 'Britney F. Johnson', '972-421-6933'),
(23, 'Rachelle J. Martin', '920-397-4224'),
(24, 'Leila E. Ledoux', '615-425-9930'),
(25, 'Darrell A. Fields', '708-887-1913'),
(26, 'Linda D. Carter', '909-386-7998'),
(27, 'Melva J. Palmisano', '630-643-8763'),
(28, 'Jessica V. Windham', '513-807-9224'),
(29, 'Karen T. Martin', '847-385-1621'),
(30, 'Jack K. McDonough', '561-641-4509'),
(31, 'John M. Williams', '508-269-9346'),
(32, 'Amelia W. Davis', '347-537-8052'),
(33, 'Gertrude W. Lawrence', '510-702-7415'),
(34, 'Michael L. Harris', '252-219-4076'),
(35, 'Casey A. Groves', '810-334-9674'),
(36, 'James H. Wilson', '865-259-6772'),
(37, 'James A. Wesley', '443-217-1859'),
(38, 'Armando C. Gay', '716-252-9230'),
(39, 'James M. Duarte', '402-840-0541'),
(40, 'Jason E. West', '360-610-7730'),
(41, 'Gloria H. Saucedo', '205-861-3306'),
(42, 'Paul T. Moody', '914-683-4994'),
(43, 'Sandra L. Williams', '310-335-1336'),
(44, 'Elaine T. Deville', '626-513-8306'),
(45, 'Robyn L. Spangler', '754-224-7023'),
(46, 'Sam A. Pino', '806-823-5344'),
(47, 'Joseph H. Marble', '201-917-2804'),
(48, 'Mark M. Bassett', '206-592-4665'),
(49, 'Edgar M. Billy', '978-365-0324'),
(50, 'Connie M. Yang', '815-288-5435');
-->