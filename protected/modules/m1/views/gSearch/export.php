<?php
$date = md5(microtime());
$filename = 'export-person-' . $date;
header("Content-Type: application/x-msexcel; name=\"" . $filename . "\"");
header("Content-Disposition: inline; filename=\"" . $filename . "\"");

$html = '';
$where = 'WHERE TRUE';
$where .= " AND company_id = " . sUser::model()->myGroup;

if (isset($_REQUEST['gBiPerson'])) {

    $html .= "<table>";
    $html .= "<tr><td colspan='3'><b style='font-size:12px;'>SUMMARY RESULTS</b></td></tr>";
    $html .= "</table>";


    //summary filter
    $i = 0;
    foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

        if ($i > 0) {
            if (!empty($_REQUEST['gBiPerson'][$key])) {
                $regex_key[$i] = implode("|", array_filter($_REQUEST['gBiPerson'][$key]));
                if (!empty($regex_key[$i])) {
                    $where .= " AND $key REGEXP '$regex_key[$i]'";
                }
            }
        }
        $i++;
    }


    //summary results
    $i = 0;
    foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {

        if ($i > 0) {
            if (isset($_REQUEST['Summary'][$key])) {
                $sql[$i] = "SELECT count($key) as sum, $key FROM (SELECT * FROM g_bi_person $where) as person group by $key";
                $result[$i] = Yii::app()->db->createCommand($sql[$i])->queryAll();
                $html .= "<table style='font-size:11px'border='1' class='table table-bordered table-condensed table-striped' style='font-size:12px;'>";
                $html .= '<tr>';
                $html .= '<td>&nbsp;</td>';
                $html .= "<td><b>$key Filter</b></td><td><b><b>SUM</b></b></td>";
                $html .= '</tr>';
                foreach ($result[$i] as $data) {
                    $html .= "<tr>";
                    $html .= '<td>&nbsp;</td>';
                    $html .= "<td width='80%'>$data[$key]</td><td>$data[sum]</td>";
                    $html .= "</tr>";
                }
                $html .= "</table>";

                $html .= "<table>";
                $html .= "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
                $html .= "</table>";
            }
        }
        $i++;
    }
}

$sql_gridview = "SELECT @rownum:=@rownum+1 'rank', p.* FROM g_bi_person p, (SELECT @rownum:=0) r $where";
$results_gridview = Yii::app()->db->createCommand($sql_gridview)->queryAll();

$kol = 1;
$html .= "<table style='font-size:12px;' border='1'>";
$html .= "<tr>";
foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {
    $key = strtoupper($key);
    if ($kol == 1) {
        $html .= "<td align='left'><b>NO.</b></td>";
    } else {
        $html .= "<td align='left'><b>$key</b></td>";
    }
    $kol++;
}
$html .= "</tr>";

$i = 1;
foreach ($results_gridview as $data) {
    $html .= "<tr>";
    foreach (Yii::app()->db->schema->getTable('g_bi_person')->columns as $key => $val) {
        if ($key == 'id') {
            $html .= "<td style='vertical-align:top;'>$i</td>";
        } else {
            $html .= "<td style='vertical-align:top;'>$data[$key]</td>";
        }
    }
    $i++;
    $html .= "</tr>";
}
$html .= '</table>';


$fh = fopen($_SERVER['DOCUMENT_ROOT'] . "/sharedocs/temporarydocuments/exports/" . $filename . '.xls', "a+");
fwrite($fh, $html);
fclose($fh);

echo $filename . ".xls";
