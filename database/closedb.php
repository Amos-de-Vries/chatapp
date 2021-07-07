<?php
// CREATED BY: SANDER, AMOS, JASON
// 07/07/2021
// HACKATON

if (is_bool($result) === false) {
	mysqli_free_result($result);
}

mysqli_close($dbaselink);

?>