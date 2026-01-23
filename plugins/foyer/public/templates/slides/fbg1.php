<?php

/**
 * Text slide format template.
 *
 * @since	1.5.0
 */

$slide = new Foyer_Slide(get_the_id());

$slide_text_pretitle = get_post_meta($slide->ID, 'slide_text_pretitle', true);
$slide_text_title = get_post_meta($slide->ID, 'slide_text_title', true);
$slide_text_subtitle = get_post_meta($slide->ID, 'slide_text_subtitle', true); // Subtitle innehåller default Google Slide URL
$slide_text_content = get_post_meta($slide->ID, 'slide_text_content', true);
$slide_text_extraspace = get_post_meta($slide->ID, 'slide_text_extraspace', true );
// Välj slide efter veckodag

$googleslide = $slide_text_subtitle;
$extraspace = $slide_text_extraspace;
$weekurl = [];

$weekurl[1] = get_post_meta( $slide->ID, 'slide_text_url1', true );
$weekurl[2] = get_post_meta( $slide->ID, 'slide_text_url2', true );
$weekurl[3] = get_post_meta( $slide->ID, 'slide_text_url3', true );
$weekurl[4] = get_post_meta( $slide->ID, 'slide_text_url4', true );
$weekurl[5] = get_post_meta( $slide->ID, 'slide_text_url5', true );

// Matstöd

$matspecial[1] = 'Pasta och köttbullar, vegoboll';
$matspecial[2] = 'Pasta och kycklingkorv, veggiekorv';
$matspecial[3] = 'Pasta och köttbullar, vegoboll';
$matspecial[4] = 'Kokt potatis och schnitzel, panerad fisk';
$matspecial[5] = 'Pasta och kycklingkorv, veggiekorv';


$daynum = date("N", time());

if (!empty($weekurl[$daynum])) {
	$googleslide = $weekurl[$daynum];
}


?>
<style>
.infotext {
	font-size: 2em;
}
.iframe-crop-wrapper {
	width: 640px;      /* 1/3 av 1920 */
	height: 360px;     /* 1/3 av 1080 */ 
	overflow: hidden;
	display: inline-block;
	background: #fff;
	margin: 0 10px 0 10px;
	position: relative;
}
.extra-space {
	position: absolute;
	width: 640px;
	height: 540px;     /* 1/2 av 1080 */
	top: -90px;
	border: none;
	background: #fff;
}
.foyer-slide-fields {
	display: flex;
	flex-direction: row;
}
</style>



<div<?php $slide->classes(); ?> <?php $slide->data_attr(); ?>>
	<div class="inner">
		<div style="display: flex;">
			<div style="flex-basis: 10%; padding: 10px;">
				<script src="https://cdn.logwork.com/widget/clock.js"></script>
				<a href="https://logwork.com/clock-widget/" class="clock-time" data-style="cyanv2" data-size="150" data-timezone="Europe/Stockholm">&nbsp;</a>
			</div>
			<div style="flex-basis: 30%; padding: 10px;">
				<div class="infotext" id="dagensdatum"></div>
				<div class="infotext" id="klocka"></div>
			</div>
			<div style="flex-basis: 60%; padding: 10px;">
				<div class="infotext" id="dagenslunch"></div>
				<div class="infotext" id="matstod"><?php echo $matspecial[$daynum]; ?></div>
			</div>
		</div>

		<?php
		// Om både Google Slide och extrautrymme finns, visa båda. 
		if (!empty($googleslide) && !empty($extraspace)) { ?>
			<div class="foyer-slide-fields">
				<iframe src="<?php echo $googleslide . '&rm=minimal'; ?>" frameborder="0" width="1280" height="720"></iframe>
				<div class="iframe-crop-wrapper">
					<iframe class="extra-space" src="<?php echo $extraspace . '&rm=minimal'; ?>" frameborder="0"></iframe>
				</div>
			</div>
		<?php }
		// Om bara Google Slide finns, visa den och lägg till en tom iframe som placeholder för extrautrymmet.   
		elseif (!empty($googleslide)) { ?>
			<div class="foyer-slide-fields">
				<iframe src="<?php echo $googleslide . '&rm=minimal'; ?>" frameborder="0" width="1280" height="800"></iframe>
				<div class="iframe-crop-wrapper">
					<iframe class="extra-space" frameborder="0"></iframe>
				</div>
			</div>
		<?php }
		// Om bara extrautrymme finns, visa den och lägg till en tom iframe som placeholder för Google Slide.
		elseif (!empty($extraspace)) { ?>
			<div class="foyer-slide-fields">
				<iframe frameborder="0" width="1280" height="800"></iframe>
				<div class="iframe-crop-wrapper">
					<iframe class="extra-space" src="<?php echo $extraspace . '&rm=minimal'; ?>" frameborder="0"></iframe>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php $slide->background(); ?>
</div>


<?php
/*
<div<?php $slide->classes(); ?> <?php $slide->data_attr(); ?>>
	<div class="inner">
		<div style="display: flex;">
			<div style="flex-basis: 10%; padding: 10px;">
				<script src="https://cdn.logwork.com/widget/clock.js"></script>
				<a href="https://logwork.com/clock-widget/" class="clock-time" data-style="cyanv2" data-size="150" data-timezone="Europe/Stockholm">&nbsp;</a>
			</div>
			<div style="flex-basis: 30%; padding: 10px;">
				<div class="infotext" id="dagensdatum"></div>
				<div class="infotext" id="klocka"></div>
			</div>
			<div style="flex-basis: 60%; padding: 10px;">
				<div class="infotext" id="dagenslunch"></div>
				<div class="infotext" id="matstod"><?php echo $matspecial[$daynum]; ?></div>
			</div>
		</div>

		<?php
		// Om både Google Slide och extrautrymme finns, visa båda. 
		if (!empty($googleslide) && !empty($extraspace)) { ?>
			<div class="foyer-slide-fields" style="display: flex; flex-direction: row;">
				<iframe src="<?php echo $googleslide . '&rm=minimal'; ?>" frameborder="0" width="1280" height="800"></iframe>
				<iframe src="<?php echo $extraspace . '&rm=minimal'; ?>" frameborder="0" width="660" height="325" style="margin: 0 10px 0 10px;"></iframe>
			</div>
		<?php }
		
		// Om bara Google Slide finns, visa den och lägg till en tom iframe som placeholder för extrautrymmet.   
		elseif (!empty($googleslide)) { ?>
			<div class="foyer-slide-fields" style="display: flex; flex-direction: row;">
				<iframe src="<?php echo $googleslide . '&rm=minimal'; ?>" frameborder="0" width="1280" height="800"></iframe>
				<iframe frameborder="0" width="660" height="325" style="margin: 0 10px 0 10px;"></iframe>
			</div>
		<?php }
		
		// Om bara extrautrymme finns, visa den och lägg till en tom iframe som placeholder för Google Slide.
		elseif (!empty($extraspace)) { ?>
			<div class="foyer-slide-fields" style="display: flex; flex-direction: row;">
				<iframe frameborder="0" width="1280" height="800"></iframe>
				<iframe src="<?php echo $extraspace . '&rm=minimal'; ?>" frameborder="0" width="660" height="325" style="margin: 0 10px 0 10px; "></iframe>
			</div>
		<?php } ?>
	</div>
	<?php $slide->background(); ?>
</div>

*/ ?>


	<script>
		function fyllDagensLunch() {
			// Hämta referensen till din div
			var lunchDiv = document.getElementById("dagenslunch");

			// Kontrollera att div-referensen är giltig
			if (lunchDiv) {
				// Skapa en XMLHttpRequest-objekt
				var xhr = new XMLHttpRequest();

				// Ange URL:en för JSON-dokumentet
				var url = "https://intranet.falkenberg.se/fbg_apps/services/skolmat/soderskolan_rss.php";

				// Ange att vi vill använda GET-metoden och att förfrågan ska vara asynkron
				xhr.open("GET", url, true);

				// Ange att vi förväntar oss ett JSON-svar
				xhr.setRequestHeader("Content-Type", "application/json");

				// Lyssna på förändringar i förfrågningsstatusen
				xhr.onreadystatechange = function() {
					if (xhr.readyState === 4 && xhr.status === 200) {
						// Om förfrågan är klar och framgångsrik
						var jsonData = JSON.parse(xhr.responseText);

						var today = new Date();

						// Get the year, month, and day from the Date object
						var year = today.getFullYear();
						var month = (today.getMonth() + 1).toString().padStart(2, '0'); // Add leading zero if needed
						var day = today.getDate().toString().padStart(2, '0'); // Add leading zero if needed

						// Create the formatted date string
						var formattedDate = year + '-' + month + '-' + day;

						// Hämta lunchobjektet för datumet formattedDate
						var lunchItems = jsonData.weeks[0].days.find(function(day) {
							return day.date === formattedDate;
						}).items;

						// Kontrollera om det finns lunchobjekt för det angivna datumet
						if (lunchItems && lunchItems.length > 0) {
							// Skapa en textnod för varje lunchobjekt
							lunchItems.forEach(function(item) {
								var lunchText = document.createTextNode(item);
								lunchDiv.appendChild(lunchText);
								lunchDiv.appendChild(document.createElement("br"));
							});
						} else {
							// Om det inte finns några lunchobjekt för det angivna datumet
							var ingenLunchText = document.createTextNode("Ingen lunch tillgänglig.");
							lunchDiv.appendChild(ingenLunchText);
						}
					}
				};

				// Skicka förfrågan
				xhr.send();
			}
		}


		function startTime() {
			const today = new Date();
			let h = today.getHours();
			let m = today.getMinutes();
			let s = today.getSeconds();
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('klocka').innerHTML = h + ":" + m + ":" + s;
			setTimeout(startTime, 1000);
		}

		function checkTime(i) {
			if (i < 10) {
				i = "0" + i
			}; // add zero in front of numbers < 10
			return i;
		}

		// Array med veckodagar på svenska
		var veckodagar = ["Söndag", "Måndag", "Tisdag", "Onsdag", "Torsdag", "Fredag", "Lördag"];

		// Array med månader på svenska
		var manader = ["januari", "februari", "mars", "april", "maj", "juni", "juli", "augusti", "september", "oktober", "november", "december"];

		// Skapa ett Date-objekt för aktuellt datum
		var idag = new Date();

		// Hämta veckodag, datum och månad
		var veckodag = veckodagar[idag.getDay()];
		var dag = idag.getDate();
		var manad = manader[idag.getMonth()];
		var ar = idag.getFullYear();

		// Skapa textsträngen för att visa datumet på svenska
		var datumText = veckodag + " " + dag + " " + manad + " " + ar;

		// Skriv ut datumet i elementet med id "date"
		document.getElementById("dagensdatum").textContent = datumText;

		startTime();
		fyllDagensLunch();

		function reloadPage() {
        location.reload();
    }

    setTimeout(reloadPage, 600000); // 10 minutes in milliseconds
	</script>