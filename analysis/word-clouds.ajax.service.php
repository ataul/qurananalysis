<?php 
#   PLEASE DO NOT REMOVE OR CHANGE THIS COPYRIGHT BLOCK
#   ====================================================================
#
#    Quran Analysis (www.qurananalysis.com). Full Semantic Search and Intelligence System for the Quran.
#    Copyright (C) 2015  Karim Ouda
#
#    This program is free software: you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
#    You can use Quran Analysis code, framework or corpora in your website
#	 or application (commercial/non-commercial) provided that you link
#    back to www.qurananalysis.com and sufficient credits are given.
#
#  ====================================================================
require_once("../global.settings.php");

$lang = "AR";


if ( isset($_GET['lang']) )
{
	$lang = $_GET['lang'];
}

loadModels("core",$lang);

$cloudToShow = $_GET['cloudToShow'];

if ( $cloudToShow!="0" && empty($cloudToShow) )
{
	showTechnicalError("Invalid Cloud Type [$cloudToShow]");
	exit;
}


$RESOURCES = getModelEntryFromMemory($lang, "MODEL_CORE", "RESOURCES", "");
	
$META_DATA = getModelEntryFromMemory($lang, "MODEL_CORE", "META_DATA", "");

$WORDS_FREQUENCY = getModelEntryFromMemory($lang, "MODEL_CORE", "WORDS_FREQUENCY", "");

?>
			
					

			  <?php if ( $cloudToShow=="VB"):?>
			  
			  <fieldset class="word-cloud-fs">
		  		 
  				    <legend><?php echo $RESOURCES['VERSE_BEGENNINGS']?></legend>
			  		
						
			  			<div id='verse-beginning-cloud' class='cloud-div'>
							<?php 
								
							shuffle_assoc($WORDS_FREQUENCY['VERSE_BEGINNINGS']);
							
								$i=0;
								foreach ($WORDS_FREQUENCY['VERSE_BEGINNINGS'] as $wordLabel => $wordFreq )
								{
									
									$freq = $wordFreq;
									$i++;
									
									
								?><a class='wordfreq-item'   href="javascript:;"  rel="<?=($freq)?>" title="<?=$freq?> "><?=$wordLabel?></a><?php 
								}
			  				?>
		 
			  		</div>
			  		
			  </fieldset>
			  
			    <?php endif;?>
			  
			    <?php if ( $cloudToShow=="VE"):?>
			  
			 <fieldset class="word-cloud-fs">
		  		 
  				    <legend><legend><?php echo $RESOURCES['VERSE_ENDINGS']?></legend></legend>
			  		
						
			  			<div id='verse-endings-cloud' class='cloud-div'>
							<?php 
						
								shuffle_assoc($WORDS_FREQUENCY['VERSE_ENDINGS']);
							
								$i=0;
								foreach ($WORDS_FREQUENCY['VERSE_ENDINGS'] as $wordLabel => $wordFreq )
								{
									
									$freq = $wordFreq;
									$i++;
									
									
								?><a class='wordfreq-item'   href="javascript:;"  rel="<?=($freq)?>" title="<?=$freq?> "><?=$wordLabel?></a><?php 
								}
			  				?>
		 
			  		</div>
			  		
			  </fieldset>
			  
			  
			  <?php endif;?>
			  
			  <?php 
			
			  if ( is_numeric($cloudToShow) && $cloudToShow >=0 && $cloudToShow<=113):?>
			  
			  
				  <?php 
				  
					  $i=0;
					
					  	
					  	$cloudId = "qc-s-$cloudToShow";
					  	$suraName = $META_DATA['SURAS'][$cloudToShow]['name_'.strtolower($lang)];
				  ?>
				  
				 	 <fieldset class="word-cloud-fs" style="min-height:auto">
			  		 
	  				    <legend><?=$suraName?></legend>
				  		
							
				  			<div id='<?=$cloudId?>' class='cloud-div'>
								<?php 
							
									$suraWordFreqArr = $WORDS_FREQUENCY['WORDS_PER_SURA'][$cloudToShow];
									shuffle_assoc($suraWordFreqArr);
								
									$i=0;
									foreach ($suraWordFreqArr as $wordLabel => $wordFreq )
									{
										
										$freq = $wordFreq;
										$i++;
										
										
									?><a class='wordfreq-item-for-sura'   href="javascript:;"  rel="<?=($freq)?>" title="<?=$freq?> "><?=$wordLabel?></a><?php 
									}
				  				?>
			 
				  		</div>
				  		
				  </fieldset>
				  
				  <script>
				  	     $("#<?=$cloudId?> a").tagcloud({ 
						     size: { 
						       start: 14, 
						       end: 82, 
						       unit: 'px',
						       
						     },
						     color: {start: '#000', end: '#C0DE22'}
						  }); 
				</script>
				  
		
			 
			  <?php endif;?>


	<script type="text/javascript">

				
		$(document).ready(function()
		{


		
		});
		

	     <?php if ( $cloudToShow=="VB"):?>

		     <?php endif;?>

		     <?php if ( $cloudToShow=="VB"):?>
		     $("#verse-beginning-cloud a").tagcloud({ 
			     size: { 
			       start: 12, 
			       end: 100, 
			       unit: 'px',
			       
			     },
			     color: {start: '#000', end: '#C0DE22'}
			  }); 
			<?php endif;?>
			
		    <?php if ( $cloudToShow=="VE"):?>
		     $("#verse-endings-cloud a").tagcloud({ 
			     size: { 
			       start: 12, 
			       end: 100, 
			       unit: 'px',
			       
			     },
			     color: {start: '#000', end: '#C0DE22'}
			  }); 
		     <?php endif;?>
		     

		     
		</script>
		




