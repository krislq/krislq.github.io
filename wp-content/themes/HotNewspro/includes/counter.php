<?php if (get_option('swt_count') == 'Display') { ?>
<?php
function MyCounter() {
$counterFile="wp-content/themes/count.dat";
if (!file_exists($counterFile)) {
   if (!file_exists(dirname($counterFile))) {
     mkdir(dirname($counterFile), 0700);
   }
   exec("echo 0 > $counterFile");
}
$fp = fopen($counterFile,"rw");
$num = fgets($fp,5);
$num += 1;//累加1；
print "<font color=black>$num</font>";
exec("rm -rf $counterFile");
exec("echo $num > $counterFile");
}
echo("您是第 ");
print mycounter();
echo(" 位访客");
?>
<?php } else { } ?>