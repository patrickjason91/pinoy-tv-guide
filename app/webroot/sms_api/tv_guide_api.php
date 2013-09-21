<?php

    function getCurrentHourSched() {
        $data = file_get_contents("http://pinoytvguide.azurewebsites.net/listingsapi/");
        $jsonArr = json_decode($data, true);
        if (!empty($jsonArr)) {
            
            foreach ($jsonArr as $show) {
                $ch_no = $show["Channel"]["channel_no"];
                $ch_name = $show["Channel"]["channel_name"];
                $show = $show["TvProgram"]["program_name"];
                $time_start = date("g:i A",strtotime($show["TvProgramSchedule"]["time_start"]));
                $time_end = date("g:i A",strtotime($show["TvProramSchedule"]["time_end"]));
            }
        }
        
        /*
         * [
            {
                "Channel": {
                    "channel_id": "1",
                    "channel_no": "2",
                    "channel_name": "ABS-CBN"
                },
                "TvProgram": {
                    "program_id": "151",
                    "program_name": "Showbiz Inside Report"
                },
                "TvCategory": {
                    "category_name": "Talk"
                },
                "TvProgramSchedule": {
                    "time_start": "2013-09-21 15:00:00",
                    "time_end": "2013-09-21 16:00:00"
                }
            },
            {
                "Channel": {
                    "channel_id": "1",
                    "channel_no": "2",
                    "channel_name": "ABS-CBN"
                },
                "TvProgram": {
                    "program_id": "231",
                    "program_name": "SOCO: Scene of the Crime Operatives"
                },
                "TvCategory": {
                    "category_name": "Investigative"
                },
                "TvProgramSchedule": {
                    "time_start": "2013-09-21 16:00:00",
                    "time_end": "2013-09-21 16:45:00"
                }
            },
            {
                "Channel": {
                    "channel_id": "1",
                    "channel_no": "2",
                    "channel_name": "ABS-CBN"
                },
                "TvProgram": {
                    "program_id": "17",
                    "program_name": "Failon Ngayon"
                },
                "TvCategory": {
                    "category_name": "Public Service"
                },
                "TvProgramSchedule": {
                    "time_start": "2013-09-21 16:45:00",
                    "time_end": "2013-09-21 17:30:00"
                }
            },
            {
                "Channel": {
                    "channel_id": "4",
                    "channel_no": "7",
                    "channel_name": "GMA"
                },
                "TvProgram": {
                    "program_id": "161",
                    "program_name": "Startalk"
                },
                "TvCategory": {
                    "category_name": "Talk"
                },
                "TvProgramSchedule": {
                    "time_start": "2013-09-21 14:45:00",
                    "time_end": "2013-09-21 16:00:00"
                }
            }
        ]
         */
    }
    
    function getSchedOnSpecificHour() {
        
    }
?>
