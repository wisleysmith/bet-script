<p>Stake: <?php echo $this->getStake(); ?></p>
<p>Winnings: <?php echo $this->getWinnings(); ?></p>
<table>
<tr><td style="width:150px;">Name</td><td style="width:100px;">Pick</td><td style="width:50px;" >Odds</td><td style="width:50px;">Status</td></tr>
<?php 
foreach($this->getBetSlipData() as $b)
{ 
?> 
	<tr><td><?php echo $b['event_bets_name']; ?></td><td><?php echo $b['event_value_name']?></td><td><?php echo $b['odd_value']?></td><td><?php if($b['is_correct']==1) {echo 'Correct';} else if ($b['is_correct']===0){echo 'Miss';}else{echo 'Not Set';}?></td></tr>
<?php 
}
?>
</table>