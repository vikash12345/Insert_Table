<?
require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php'
;$MyWebsite = 'http://202.61.43.53/cfms-hc-search/cases/search-result?CasesSearch%5BCASENAMECODE%5D=&CasesSearch%5BCASENO%5D=&CasesSearch%5BCASEYEAR%5D=&CasesSearch%5BCIRCUITCODE%5D=&CasesSearch%5BMATTERCODE%5D=&CasesSearch%5BPARTY%5D=&CasesSearch%5BGOVT_AGENCY_CODE%5D=&CasesSearch%5BFIRNO%5D=&CasesSearch%5BFIRYEAR%5D=&CasesSearch%5BPOLICESTATIONCODE%5D=&CasesSearch%5BADVOCATECODE%5D=&CasesSearch%5BisPending%5D=3&page=';

for ($page = 1; $page < 2; $serialnumb++) 
     {
        $NewURL = $MyWebsite . $serialnumb . '&per-page=15';
        $html = file_get_html($NewURL);

               
        foreach($html->find("//*[@id='w1-container']/table/tbody/tr") as $element)
        {
           $number = $element->find("td", 1);
           echo $number;
           echo '<br/>';
        }
 echo '-------------------------------------------<br/>';

    }     
?>
