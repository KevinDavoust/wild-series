<?php

namespace App\Service;

use App\Entity\Program;

class ProgramDuration
{

    public function calculate(Program $program): string
    {
        $seasons = $program->getSeasons();
        $totalDuration = 0;

        foreach ($seasons as $season){
            $episodes = $season->getEpisodes()->toArray();


            foreach ($episodes as $episode) {
                $episodeDuration = $episode->getDuration();
                $totalDuration += $episodeDuration;
            }
        }

        $days = floor($totalDuration / 1440); // 1440 minutes in a day
        $hours = floor(($totalDuration % 1440) / 60);
        $minutes = $totalDuration % 60;

        $durationString = "";

        if ($days = 1) {
            $durationString .= $days . " day ";
        }

        if ($days > 1) {
            $durationString .= $days . " days ";
        }

        if ($hours = 1) {
            $durationString .= $hours . " hour ";
        }
        if ($hours > 1) {
            $durationString .= $hours . " hours ";
        }

        if ($minutes > 0) {
            $durationString .= $minutes . " minutes";
        }

        return $durationString;
    }
}