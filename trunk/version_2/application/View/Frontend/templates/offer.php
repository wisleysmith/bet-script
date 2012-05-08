 <div id="ticketBox">
 	<p>Ticket:</p> 
  	<div id="ticket"> 
	</div>
	<div>
  		<p>Stake: <input style="width:50px" id="betStake" type="text" /></p>
  		Odds: <span id="betOdds" /></span><br />
  		Winnings: <span id="betWinnings" ></span> <br />
  		<p>
  		<input type="button" id="placeBet" value="Place" />
  		<input type="button" id="resetBet" value="Reset" />
  		</p>
  	</div>
</div>

<div class="fullWidthTableFrontEnd"  >
	<div class="innerTable"> 
		<?php echo $this->getEventListWidget();?>
	</div>
</div> 

<?php 
foreach ($this->getOfferList() as $o)
{
?>
<div class="fullWidthTableFrontEnd"  >
	<div class="innerTable"> 
		<?php echo $o;?>
	</div>
</div> 
<?php 
}
?>