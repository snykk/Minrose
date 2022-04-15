<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?php
if (isset($data["js"])){
    echo "<script src=" . BASEURL . "/js/" . $data['js'] . ".js></script>";
}
?>
</body>
</html>