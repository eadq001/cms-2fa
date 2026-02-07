<?php
declare(strict_types=1);

\Core\Session::destroy();
redirect('/login');

?>