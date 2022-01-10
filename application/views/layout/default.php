<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?=$title_for_layout?></title>
<link rel="stylesheet" href="/inc/foundation.min.css">
<script type="text/javascript" src"/inc/jquery.js"></script>
<script type="text/javascript" src"/inc/foundation.js"></script>
</head>
<body>

<?= $content_for_layout ?>

<script type="text/javascript">
$(document).foundation()
</script>
</body>
</html>