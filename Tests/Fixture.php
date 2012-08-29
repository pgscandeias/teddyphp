<?php
namespace Tests;

class Fixture
{
    public static function generateCandidateData()
    {
        return array(
            'name'			=> 'Candidate Name',
    		'email'			=> 'candidate@email.com',
            'dateOfBirth'	=> '1982-01-01',
        );
    }
    
    public static function generateSkillData()
    {
        $uniqid = uniqid();
        return array(
            'title' => $uniqid,
            'grade' => 4,
            'notes' => 'Notes for skill #'.$uniqid,
        );
    }
    
    public static function generateProjectData($year)
    {
        $uniqid = uniqid();
        return array(
            'title' => $uniqid,
            'role'  => 'Role name',
            'start' => $year.'-01-01',
            'end'   => $year.'-12-31',
            'notes' => 'Notes about this project',
        );
    }
    
    public static function generateEducationData()
    {
        $uniqid = uniqid();
        return array(
            'year'      => rand(1990, 2011),
            'school'    => 'School of '.$uniqid,
            'title'     => 'Degree in '.$uniqid,
            'grade'     => rand(10, 20),
            'notes'     => 'Notes about the education in '.$uniqid,
        );
    }
    
    public static function generateLanguagesArray()
    {
        $langs = array(
            'Portuguese',
            'English',
            'Spanish',
            'French',
        );
        foreach($langs as $lang) {
            $out[] = array(
                'language'  => $lang,
                'grade'     => rand(1,4),
            );
        }
        return $out;
    }
}