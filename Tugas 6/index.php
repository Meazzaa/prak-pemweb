<?php
function convertToRoman($number){
    $romans = array(
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1
    );

    $result = '';

    foreach ($romans as $roman => $value) {
        $matches = intval($number / $value);

        $result .= str_repeat($roman, $matches);
        $number = $number % $value;
    }

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["angkaBiasa"]) && is_numeric($_POST["angkaBiasa"])) {
        $angkaBiasa = intval($_POST["angkaBiasa"]);
        $romawi = convertToRoman($angkaBiasa);
    } else {
        $error_message = "Masukkan angka yang valid.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Angka ke Romawi</title>
</head>

<body>
    <h2>Konversi Angka ke Romawi</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Masukkan Angka Biasa: <input type="text" name="angkaBiasa" value="<?php echo isset($angkaBiasa) ? $angkaBiasa : ''; ?>">
        <input type="submit" value="Konversi">
    </form>

    <?php
    if (isset($romawi)) {
        echo "<p>Angka biasa: $angkaBiasa</p>";
        echo "<p>Bentuk romawi: $romawi</p>";
    } else if (isset($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
</body>
</html>
