<div class="row">
    <div class="col-md-4">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td align="center">
                    <h3><?php echo peterFunc::indoFormat(tAccount::getTotalAssets(Yii::app()->params["cCurrentPeriod"])) ?></h3>
                    <h6 align="center"><font COLOR="#999">Total Activa/Passiva</font></h6></td>
            </tr>
        </table>
    </div>

    <div class="col-md-4">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td align="center">
                    <h3><?php echo peterFunc::indoFormat(tAccount::getTotalSalesHppExpense(Yii::app()->params["cCurrentPeriod"], 5)) ?></h3>
                    <h6 align="center"><font COLOR="#999">Total Sales / Omzet</font></h6></td>
            </tr>
        </table>
    </div>

    <div class="col-md-4">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td align="center">
                    <h3><?php echo peterFunc::indoFormat(tAccount::netprofit(Yii::app()->params["cCurrentPeriod"])) ?></h3>
                    <h6 align="center"><font COLOR="#999">Net Income</font></h6></td>
            </tr>
        </table>
    </div>

    <?php /*
      <div class="col-md-2">
      <table width="100%">
      <tr bgcolor="EAEFFF">
      <td  align="center"><h3>.</h3>
      <h6 align="center" ><font COLOR="#999">Reserved</font></h6></td>
      </tr>
      </table>
      </div>
     */
    ?>

</div>

<br/>

<div class="row">
    <div class="col-md-4">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td align="center">
                    <h3><?php echo peterFunc::indoFormat(tAccount::getTotalPerAccount(Yii::app()->params["cCurrentPeriod"], 2)) ?></h3>
                    <h6 align="center"><font COLOR="#999">Total Aktiva Lancar</font></h6></td>
            </tr>
        </table>
    </div>

    <div class="col-md-4">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td align="center">
                    <h3><?php echo peterFunc::indoFormat(tAccount::getTotalPerAccount(Yii::app()->params["cCurrentPeriod"], 20)) ?></h3>
                    <h6 align="center"><font COLOR="#999">Total Hutang Lancar</font></h6></td>
            </tr>
        </table>
    </div>

    <div class="col-md-4">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td align="center">
                    <h3><?php echo peterFunc::indoFormat(tAccount::getTotalPerAccount(Yii::app()->params["cCurrentPeriod"], 26)) ?></h3>
                    <h6 align="center"><font COLOR="#999">Modal</font></h6></td>
            </tr>
        </table>
    </div>

    <?php /*
      <div class="col-md-2">
      <table width="100%">
      <tr bgcolor="EAEFFF">
      <td  align="center"><h3>.</h3>
      <h6 align="center" ><font COLOR="#999">Reserved</font></h6></td>
      </tr>
      </table>
      </div>
     */
    ?>

</div>

<br/>
