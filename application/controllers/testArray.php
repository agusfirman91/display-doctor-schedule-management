<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TestArray extends CI_Controller
{
    public function index()
    {
        // $status =  array('suami', 'istri', 'anak perempuan', 'anak laki- laki');
        $keluarga =  array(
            'suami',
            'istri',
            'anak perempuan',
            'anak laki- laki',
            '[0]' => 'lamry',
            '[0][1]' => 'guntur',
            '[0][2]' => 'agus firman',
            '[1][0]' => 'julaehah',
            '[1][1]' => 'mira lastarina',
            '[1][2]' => 'risna novianti',
            '[2]' => array(
                '[2][0]julaehah'       => 'mira lastarina',
                '[2][1]julaehah'       => 'illa afriyanti',
                '[2][2]julaehah'       => 'fojiyatul aeni',
                '[2][3]julaehah'       => 'nova lestari',
                '[2][4]mira lastarina' => 'nazwa nuraeni',
                '[2][5]mira lastarina' => 'kanaya izzatun nisa',
                '[2][6]risna novianti' => 'izza hilyah nafisah'
            ), '[3]' => array(
                '[3][0]julaehah' => 'agus firman',
                '[3][1]julaehah' => 'safrudin',
                '[3][3]julaehah' => 'miftahul huda'
            )
        );
        // $c = array_combine($status, $keluarga);

        // print_r($c);
        // print_r($status);
        // print_r($keluarga);

        // $keluarga = array();
        // foreach ($keluarga as $values) {
        //     $tmp[$values['0']][] = $values['0'];
        // print "[$keys[$values]] {\n";
        // echo count($keys);
        // foreach ($values as $key => $value) {
        //     print " $keys=>$value \n";
        // }
        // print "}\n";
        // }
        // var_dump(count($keluarga[0]));

        // $fees['agus']['php'] = 70;
        // $fees['agus']['java'] = 50;
        // $fees['agus']['css'] = 60;

        // $fees['firman']['php'] = 60;
        // $fees['firman']['java'] = 40;
        // $fees['firman']['css'] = 80;

        // foreach ($fees as $keys => $values) {
        //     echo "$keys {\n";
        //     foreach ($values as $key => $data) {
        //         echo "$key => $data ,";
        //     }
        //     echo "}\n";
        // }

        $args = array(
            array('suami' => 'AAA', 'istri' => 'A1,35'),
            array('suami' => 'AAA', 'istri' => 'A2,34'),
            array('suami' => 'BBB', 'istri' => 'B1,29'),
            array('suami' => 'CCC', 'istri' => 'C1,20'),
            array('suami' => 'CCC', 'istri' => 'C2,19'),
            array('suami' => 'CCC', 'istri' => 'C3,18')
        );


        // foreach ($keluarga as $arg) {
        //     $tmp[$arg['suami']][] = $arg['istri'];
        // }

        // $output = array();

        // foreach ($tmp as $suami => $labels) {
        //     $output[] = array(
        //         'suami' => $suami,
        //         'istri' => $labels
        //     );
        // }

        $rows = array(
            array(
                'id' => 33,
                'parent_id' => 0
            ),
            array(
                'id' => 23,
                'parent_id' => 0
            ),
            array(
                'id' => 27,
                'parent_id' => 33
            ),
            array(
                'id' => 17,
                'parent_id' => 0
            ),
        );

        function builTree(array $elements, $parentId = 0)
        {
            $branch = array();

            foreach ($elements as $element) {
                if ($element['perent_id'] == $parentId) {
                    $children = builTree($elements, $element['id']);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }

            return $branch;
        }

        print_r(builTree($rows));
    }
}
