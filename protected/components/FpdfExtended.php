<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FpdfExtended extends fpdf
{

    public function CellHeader($options = [])
    {

        if (empty($options["w"])) {
            throw new CException('FpdfExtension: param "w" cannot be empty.');
        }

        //if (array_sum($options["w"]) == 100) {
        //    throw new CException('FpdfExtension: total "w" must be 100.');
        //}

        $w = $options["w"] / 100 * ($this->w - $this->lMargin - $this->rMargin);

        (!isset($options["h"])) ? $h = 4 : $h = $options["h"];
        (!isset($options["txt"])) ? $txt = '' : $txt = $options["txt"];
        (!isset($options["border"])) ? $border = 1 : $border = $options["border"];
        (!isset($options["ln"])) ? $ln = 0 : $ln = $options["ln"];
        (!isset($options["align"])) ? $align = 'C' : $align = $options["align"];
        (!isset($options["fill"])) ? $fill = false : $fill = $options["fill"];
        (!isset($options["link"])) ? $link = '' : $link = $options["link"];

        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }

    public function CellStandard($options = [])
    {

        if (empty($options["w"])) {
            throw new CException('FpdfExtension: param "w" cannot be empty.');
        }

        //if (array_sum($options["w"]) == 100) {
        //    throw new CException('FpdfExtension: total "w" must be 100.');
        //}

        $w = $options["w"] / 100 * ($this->w - $this->lMargin - $this->rMargin);

        (!isset($options["h"])) ? $h = 4 : $h = $options["h"];
        (!isset($options["txt"])) ? $txt = '' : $txt = $options["txt"];
        (!isset($options["border"])) ? $border = 'LR' : $border = $options["border"];
        (!isset($options["ln"])) ? $ln = 0 : $ln = $options["ln"];
        (!isset($options["align"])) ? $align = 'L' : $align = $options["align"];
        (!isset($options["fill"])) ? $fill = false : $fill = $options["fill"];
        (!isset($options["link"])) ? $link = '' : $link = $options["link"];

        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }

}

