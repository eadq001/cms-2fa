<?php
declare(strict_types=1);

\Core\Session::destroy();
echo "
    <script>
    alert('You have logged out');
    window.location.href = '/login';
    </script>
";


?>