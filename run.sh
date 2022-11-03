for f in ./tests/input*.txt
do
   cat $f | php main.php | diff ${f/input/output} - -y && echo 'Test passed' || echo "\nTest failer"
done