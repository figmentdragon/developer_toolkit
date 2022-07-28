<!--WordPress has a built in function, the_meta(), for outputting all custom fields. But this function is limited in that it doesn’t always output all of them. For example, it misses custom fields added by plugins which begin with an _ underscore.

This bit of code uses an alternate function, get_post_custom() which will return all of them, and display all values. Good for debugging.-->

<h3>All Post Meta</h3>

<?php

  // Get all the data
  $getPostCustom = get_post_custom();

    foreach($getPostCustom as $name=>$value) {

        echo "<strong>" . $name . "</strong>"."  =>  ";

        foreach ($value as $nameAr=>$valueAr) {
                echo "<br />";
                echo $nameAr."  =>  ";
                echo var_dump($valueAr);
        }

        echo "<br /><br />";

    }
?>
