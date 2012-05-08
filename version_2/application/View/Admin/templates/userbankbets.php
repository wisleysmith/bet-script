
<div>
	<a id="bankPanelLink" href="javascript:void(0)">Bank</a> | <a id="betsPanelLink" href="javascript:void(0)">Bets</a>
</div>

<div id="bankPanel" style="display:block">
	<div class="innerTable">
	Add money to user:
	<form id="addMoneyToUser" name="addMoneyToUser" >
		<input name="model[Model_TransactionModel][user_id_FK]" type="hidden" value="<?php  echo $this->getUserId()?>" />
		<input name="model[Model_TransactionModel][money]" type="text" />
		<input name="model[Model_TransactionModel][transaction_type_id_FK]" type="hidden" value="1" />
		
		<input name="method" type="hidden" value="insert" />
		<input type="button" id="addMoney" value="Add money" />
	</form>
	</div>
	<?php echo $this->getBank()->generateView();  ?>
</div>

<div id="betsPanel" style="display:none">
	<?php echo $this->getBets()->generateView(); ?>
</div>




