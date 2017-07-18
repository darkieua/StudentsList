<? switch($error): ?>
<? case 404: ?>
        <h3>Error 404 - Page not found</h3>
             <? break; ?>
<? default: ?>
        <? if (!empty($error)): ?>
            <h3>Error: <? echo $error; ?></h3>
        <? else: ?>
            <h3>Unexpected error</h3>
        <? endif; ?>
<? endswitch; ?>