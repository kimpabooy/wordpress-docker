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

/* style för både schema och extrautrymme */
.foyer-slide-fields {
	display: flex;
	flex-direction: row;
	justify-content: center;
	align-items: flex-start;
	width: 3840px;
	max-width: 3840px;
	box-sizing: border-box;
}

/* Schema */

.schema-iframe-crop-wrapper {
	width: 2560px;
	height: 1440px;
	overflow: hidden;
	position: relative;
	background: #fff;
	box-sizing: border-box;
}
.schema-iframe {
	width: 100vw;
	height: 100vh;
	border: none;
}

/* Extrautrymme */

.extra-space-iframe-crop-wrapper {
	width: 1280px;
	height: 720px;
	overflow: hidden;
	background: #fff;
	position: relative;
	box-sizing: border-box;
}
.extra-space-iframe {
	width: 100vw;
	height: 100vh;
	border: none;
	background: #fff;
}

.foyer-slide-fields {
	display: flex;
	flex-direction: row;
	justify-content: flex-start;
	align-items: flex-start;
	width: 100vw;
	max-width: 100vw;
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
			<div class="schema-iframe-crop-wrapper">
			<iframe class="schema-iframe" src="<?php echo $googleslide . '&rm=minimal'; ?>" frameborder="0"></iframe>
				</div>
				<div class="extra-space-iframe-crop-wrapper">
					<iframe class="extra-space-iframe" src="<?php echo $extraspace . '&rm=minimal'; ?>" frameborder="0"></iframe>
				</div>
				</div>
				<?php }
		// Om bara Google Slide finns, visa endast den (ingen extra tom iframe/div)
		elseif (!empty($googleslide) && empty($extraspace)) { ?>
			<div class="foyer-slide-fields">
			<div class="schema-iframe-crop-wrapper">
			<iframe class="schema-iframe" src="<?php echo $googleslide . '&rm=minimal'; ?>" frameborder="0"></iframe>
			</div>
			</div>
		<?php }
		// Om bara extrautrymme finns, visa endast den
		elseif (!empty($extraspace) && empty($googleslide)) { ?>
			<div class="foyer-slide-fields">
				<div class="extra-space-iframe-crop-wrapper">
					<iframe class="extra-space-iframe" src="<?php echo $extraspace . '&rm=minimal'; ?>" frameborder="0"></iframe>
				</div>
			</div>
			<?php } ?>
			</div>
			<?php $slide->background(); ?>
</div>

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