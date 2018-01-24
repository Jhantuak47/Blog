@extends('layouts.app')
@section('content')
        <h2>About</h2>
            <?php
              echo "$company<br>";
              
                if($owners>0){
                    echo "<ul>";
                        foreach($owners as $owner){
                            echo "<li>" . $owner ."</li>";
                        }
                    echo "</ul>";
                } 
            ?>
 @endsection
