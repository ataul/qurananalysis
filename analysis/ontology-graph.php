<?php 
require_once("../global.settings.php");
require_once("../libs/graph.lib.php");

$lang = "AR";



if ( isset($_GET['lang']) )
{
	$lang = $_GET['lang'];
}

loadModels("core",$lang);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Quran QA Ontology Visualization | Quran Analysis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="QA Quran Ontology visualization">
    <meta name="author" content="">

	<script type="text/javascript" src="<?=$JQUERY_PATH?>" ></script>
	<script type="text/javascript" src="<?=$MAIN_JS_PATH?>"></script>
	<script type="text/javascript" src="<?=$D3_PATH?>"></script>
	<link rel="stylesheet" href="/qe.style.css?bv=<?=$BUILD_VERSION?>" />
	<link rel="icon" type="image/png" href="/favicon.png">	 
	<script type="text/javascript">
	</script>
     
       
  </head>
  <body>
		<?php 
				require("./analysis.template.start.code.php");
		
		?>		
  <div id='main-container'>
			  	
	
			
	    <?php include_once("help-content.php"); ?>
			
			  
			  	<?php 
			  	
			  		$TOTALS= getModelEntryFromMemory($lang, "MODEL_CORE", "TOTALS", "");
			  		$RESOURCES = getModelEntryFromMemory($lang, "MODEL_CORE", "RESOURCES", "");
			  	?>
			  	<div >
			  	<div id="graph-verse-or-text-selection" >
			  
			 		 
			  	
			  		<a href='javascript:openFullGraph()'>Open Full Quran Graph</a>
			  		<br/>
						<br/>
					
					<div style="direction:<?php echo ($lang=="AR")? "rtl":"ltr";?>">
					<?php echo $RESOURCES['CHOOSE_CHAPTER_OR_VERSE']?>			
					<select id='graph-verse-selection'>
					 <option suraIndex="" value="" selected="true">&nbsp;</option>
						<?php 
							foreach ($TOTALS['TOTAL_PER_SURA'] as $suraIndex => $perSuraArr )
							{
								
								$totalVerses = $perSuraArr['VERSES'];
						?>
							
								 <option suraIndex="<?=$suraIndex?>" value=<?=$perSuraArr['NAME']?>><b><?=$perSuraArr['NAME']?></option>
							
							 		
							
					  
					  <?php 
							}
					  ?>
					</select>
					</div>
					
			

			  	</div>
			  		<div id="loading-layer">
			  		Loading ...
			  	</div>
			  		<div id='graph-maingraph-area'>
							<iframe id="graphing-iframe" src="./graphing.iframe.php"></iframe>
					</div>
				</div>
	
		  		
			
   </div>
   
		<?php 
				require("./analysis.template.end.code.php");
		
		?>	
	<script type="text/javascript">

	function openFullGraph()
	{

		openPopupWindow("/analysis/ontology-full-quran-graph.php",1200,900);

		trackEvent('ANALYSIS','ontology-graph',"full",'');
			
	}
				


	$("#graph-verse-selection").change(function()
	{
        var selectedVerse = $("option:selected", this);
        var suraIndex = selectedVerse.attr("suraIndex");

      
   
			var verseIndex = selectedVerse.attr("value");

			if ( suraIndex=="" || verseIndex=="")
			{
				return;
			}

			$("#loading-layer").show();

			//alert(suraIndex+" "+verseIndex);
			
			if ( verseIndex=="ALL_SURA")
			{
				$("#graphing-iframe").attr("src","./graphing.iframe.php?s="+suraIndex+"&allSURA=1&lang=<?=$lang?>");
			}
			else
			{
				$("#graphing-iframe").attr("src","./graphing.iframe.php?s="+suraIndex+"&a="+verseIndex+"&lang=<?=$lang?>");
			}


			trackEvent('ANALYSIS','ontology-graph',suraIndex,'');

			setTimeout(function()
					{
				$("#loading-layer").hide();
					},2000);
	 });
		
	</script>
		

	<?php 
		require("../footer.php");
	?>
	


  </body>
</html>







