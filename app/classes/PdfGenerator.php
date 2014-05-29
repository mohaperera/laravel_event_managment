<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PdfGenerator extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tms:build_pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Pdf by parsing JSON Design Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $aliasname = $this->option('alias');

        $template = Template::where('alias', '=', $aliasname)->first();
        $data = json_encode($template->toArray());



        $datapdf = json_decode($data,true);

        foreach($datapdf['design_data'] as $value => $key){

            foreach($key as $member => $value){

                $x=  $value['dpi']['x'];
                $y=  $value['dpi']['y'];

                $max = sizeof($value['layers']);
                for($i=0; $i<$max;$i++){

                    $higer_url = $value['layers'][$i]['highres_url'];
                    $image_url = public_path().$higer_url;


                    $x_coordinate = $value['layers'][$i]['x'];
                    $y_coordinate = $value['layers'][$i]['y'];
                    $width = $value['layers'][$i]['width'];
                    $height = $value['layers'][$i]['height'];


                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                    $pdf->SetCreator(PDF_CREATOR);
                    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
                    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                    $pdf->AddPage();
                    $pdf->setJPEGQuality(75);

                    $imgdata = $image_url;


                    $pdf->Image($imgdata);

                    $horizontal_alignments = array('L', 'C', 'R');
                    $vertical_alignments = array('T', 'M', 'B');

                    $x = 15;
                    $y = 35;
                    $w = 30;
                    $h = 30;

                    for ($i = 0; $i < 3; ++$i) {
                        $fitbox = $horizontal_alignments[$i].' ';
                        $x = 15;
                        for ($j = 0; $j < 3; ++$j) {
                            $fitbox{1} = $vertical_alignments[$j];

                           $pdf_file = $pdf->Rect($x, $y, $w, $h, 'F', array(), array(128,255,128));
                           $pdf->Image($imgdata, $x, $y, $w, $h, 'PNG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
                            $x += 32; // new column
                        }
                        $y += 32; // new row
                    }

                    $pdf->Output(public_path().'/assets/'.$aliasname.'/preview.pdf', 'F');
                }
            }

        }

        if (is_null($template)) {
            $this->error("The given alias could not be found in the database!");
            return null;
        }

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['alias', null, InputOption::VALUE_REQUIRED, 'The alias name is required']

        ];
    }

}
