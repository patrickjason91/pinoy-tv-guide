<?php
    ask("What's your four or five digit pin? Press pound when finished", array(
        "choices"=>"[4-5 DIGITS]",
        "terminator" => "#",
        "timeout" => 15.0,
        "mode" => "dtmf",
        "interdigitTimeout" => 5,
        "onChoice" => "choiceFCN", 
        "onBadChoice" => "badChoiceFCN"
        )
    );
    function choiceFCN($event) {
        say("On Choice");
    }
    function badChoiceFCN($event) {
        say("On Bad Choice");
    }
?>