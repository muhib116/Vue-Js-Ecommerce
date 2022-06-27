<?php
/***************************************
** Title........: Search and Replace class
** Filename.....: example.ph
** Author.......: MD Omit Hasan Pavel
** Version......: See script
** Notes........:
** Last changed.: 10/09/2018
** Last change..:
***************************************/

        include('class.search_replace.inc');

/***************************************
** Create the object, set the search
** function and run it. Then change the
** pattern to find, and re-run the search.
***************************************/

        $sr = new search_replace('stepword', 'kalkerdeal', array('resources/index.php'),'resources/');
        $sr->set_search_function('quick');
        $sr->do_search();

/***************************************
** Some ouput purely for the example.
***************************************/

        header('Content-Type: text/plain');
        echo 'Number of occurences found: '.$sr->get_num_occurences()."\r\n";
        echo 'Error message.............: '.$sr->get_last_error()."\r\n";
?>
