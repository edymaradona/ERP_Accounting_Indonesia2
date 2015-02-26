<?php
/*
 * @author CGeorge
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 *
 * Usage example:
 * 
 * views/layout/main.php
 * <pre>
 * 	$this->widget('ext.search.SearchBoxPortlet');
 * </pre>
 */

Yii::import('zii.widgets.CPortlet');
class SearchBoxPortlet extends CPortlet {
	public $url=array('sCompanyDocuments/index');
	
	
	
	public function renderContent(){
		$this->render('inputBox', array('url'=>$this->url));
	}
        
	
}
