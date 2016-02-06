<?php
/**
 *    Project {$PROJECT}
 *    Copyright (C) 2015 {$AUTHOR}
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * This view is a standard form for CRUD create and edit using bootstrap.
 * @package vues
 *
 * Selection of a flight log
 */
?>
<?php $this->load->view('header'); ?>
<!-- Additional view specific header elements below -->
</head>

<body>

	<div class="container-fluid starter-template">
		<header class="row">
			<div class="col-lg-12">
				<?php $this->load->view('menu'); ?>
			</div>
		</header>

		<div class="row">
			<nav class="col-sm-1"></nav>
			<section class="col-sm-11">
				<div class="row">
					<div class="col-lg-6 col-lg-offset-4 text-error">
						<p class="text-warning"><?php echo validation_errors(); ?></p>
						<p class="text-warning"><?php echo isset($error_msg) ? $error_msg : ""; ?></p>
					</div>
				</div>
				<div class="">
<?= form_open( "flight_logs/display", array("class" => "form")); ?>
					<h2 class="form-heading"><?= isset($title) ? $title : "" ?></h2>

<INPUT id="tid" type="hidden" name="t" value="0">


<label for="a" class="sr-only">Airfield:</label>
<select name="a" size="1" class="form-control" >
<option value="LFOI">ABBEVILLE (LFOI)</option>
<option value="ABOY">Aboyne (ABOY)</option>
<option value="LOXA">AIGEN IM ENNSTAL (LOXA)</option>
<option value="LFDA">AIRE SUR L'ADOUR (LFDA)</option>
<option value="LFJR">ANGERS Marce (LFJR)</option>
<option value="LFCH">ARCACHON La teste de buch (LFCH)</option>
<option value="LFEG">ARGENTON SUR CREUSE (LFEG)</option>
<option value="EKAB">ARNBORG (EKAB)</option>
<option value="LFNJ">ASPRES SUR BUECH (LFNJ)</option>
<option value="ASTO">Aston Down (ASTO)</option>
<option value="LFHO">AUBENAS (LFHO)</option>
<option value="LFJF">AUBENASSON (LFJF)</option>
<option value="LFDH">AUCH (LFDH)</option>
<option value="EDMA">AUGSBURG (EDMA)</option>
<option value="LFLA">AUXERRE Branches (LFLA)</option>
<option value="LFNT">AVIGNON Pujaut (LFNT)</option>
<option value="YBSS">BACCHUS MARSH (YBSS)</option>
<option value="EDRA">Bad Neuenahr Ahrweiler (EDRA)</option>
<option value="LFCB">BAGNERES DE LUCHON (LFCB)</option>
<option value="LFFL">BAILLEAU Armenonville (LFFL)</option>
<option value="EBKH">BALEN KEIHEUVEL (EBKH)</option>
<option value="LFMR">BARCELONNETTE Saint Pons (LFMR)</option>
<option value="LLBS">BE'ER SHEVA Teyman (LLBS)</option>
<option value="LFGG">BELFORT Chaux (LFGG)</option>
<option value="LSTB">BELLECHASSE (LSTB)</option>
<option value="YBLA">BENALLA (YBLA)</option>
<option value="LSGB">BEX (LSGB)</option>
<option value="LSZF">BIRRFELD (LSZF)</option>
<option value="EDMC">BLAUBEUREN (EDMC)</option>
<option value="EDKB">BONN-HANGELAR (EDKB)</option>
<option value="ESSD">BORLANGE (ESSD)</option>
<option value="LFHS">BOURG Ceyzeriat (LFHS)</option>
<option value="EBBT">BRASSCHAAT (EBBT)</option>
<option value="EDVE">BRAUNSCHWEIG-WOLFSBURG (EDVE)</option>
<option value="LFFB">BUNO BONNEVAUX (LFFB)</option>
<option value="LFYG">CAMBRAI Niergnies (LFYG)</option>
<option value="LFNH">CARPENTRAS (LFNH)</option>
<option value="LJCL">CELJE (LJCL)</option>
<option value="EDVC">CELLE-ARLOH (EDVC)</option>
<option value="CELL">Celle-Scheuen (CELL)</option>
<option value="LFQK">CHALON Ecury sur Coole (LFQK)</option>
<option value="LFLE">CHAMBERY Challes-Les-Eaux (LFLE)</option>
<option value="LFOR">CHARTRES Champhol (LFOR)</option>
<option value="LFMX">CHATEAU ARNOUX Saint Auban (LFMX)</option>
<option value="UKCHP">CHIPPING (UKCHP)</option>
<option value="LFGA">COLMAR Houssen (LFGA)</option>
<option value="LFAD">COMPIEGNE Margny (LFAD)</option>
<option value="LFID">CONDOM Valence sur Baise (LFID)</option>
<option value="LFPK">COULOMMIERS Voisins (LFPK)</option>
<option value="LSZJ">COURTELARY (LSZJ)</option>
<option value="ESKD">DALA Jarna (ESKD)</option>
<option value="EHDL">DEELEN (EHDL)</option>
<option value="DVOO">DeVoorst (DVOO)</option>
<option value="EBDT">DIEST SCHAFFEN (EBDT)</option>
<option value="LFGI">DIJON Darois (LFGI)</option>
<option value="LIVD">DOBBIACO (LIVD)</option>
<option value="EDTD">DONAUESCHINGEN (EDTD)</option>
<option value="DUNS">Dunstable (DUNS)</option>
<option value="LKDK">DVUR KRALOVE (LKDK)</option>
<option value="EAST">Easterton (EAST)</option>
<option value="ENSM">ELVERUM/STARMOEN (ENSM)</option>
<option value="ENEMO">Enemonzo (ENEMO)</option>
<option value="EDNE">ERBACH (EDNE)</option>
<option value="ESSC">Eskilstuna (ESSC)</option>
<option value="LFAS">FALAISE Monts-d'Eraines (LFAS)</option>
<option value="LFMF">FAYENCE (LFMF)</option>
<option value="LOKF">Feldkirchen-Ossiacher See (LOKF)</option>
<option value="LIPF">FERRARA (LIPF)</option>
<option value="UKFES">Feshiebridge (UKFES)</option>
<option value="LFFK">FONTENAY LE COMTE (LFFK)</option>
<option value="LEFM">FUENTEMILANOS (LEFM)</option>
<option value="LFNA">GAP Tallard (LFNA)</option>
<option value="EDPT">GERSTETTEN (EDPT)</option>
<option value="EHGR">GILZE-RIJEN (EHGR)</option>
<option value="EDLG">GOCH-ASPERDEN (EDLG)</option>
<option value="EDSG">GRABENSTETTEN (EDSG)</option>
<option value="GRAN">Gransden Lodge Airfield (GRAN)</option>
<option value="LOWG">GRAZ (LOWG)</option>
<option value="LFLG">GRENOBLE Le Versoud (LFLG)</option>
<option value="HABE">Habere Poche (HABE)</option>
<option value="EDST">HAHNWEIDE (EDST)</option>
<option value="EGWN">HALTON (EGWN)</option>
<option value="LSZN">HAUSEN AM ALBIS (LSZN)</option>
<option value="EHHV">HILVERSUM (EHHV)</option>
<option value="EDVH">HODENHAGEN (EDVH)</option>
<option value="EHHO">HOOGEVEEN (EHHO)</option>
<option value="HOYA">Hoya (HOYA)</option>
<option value="HUSB">Husbands Bosworth (HUSB)</option>
<option value="EFHV">HYVINKAA (EFHV)</option>
<option value="ISER">Iserlohn (ISER)</option>
<option value="LFHA">ISSOIRE Le Broc (LFHA)</option>
<option value="LFEK">ISSOUDUN Le Fay (LFEK)</option>
<option value="LFIX">ITXASSOU (LFIX)</option>
<option value="EFJM">JAMIJARVI (EFJM)</option>
<option value="ESSX">JOHANNISBERG (ESSX)</option>
<option value="LFFJ">JOINVILLE Mussey (LFFJ)</option>
<option value="EDWJ">JUIST (EDWJ)</option>
<option value="EKKL">KALUNDBORG (EKKL)</option>
<option value="KAME">Kamen-Heeren (KAME)</option>
<option value="EGBP">KEMBLE (EGBP)</option>
<option value="FYKH">Kiripotib (FYKH)</option>
<option value="KIRT">Kirton in Lindsey (KIRT)</option>
<option value="EDCI">KLIX (EDCI)</option>
<option value="KOEND">Koenigsdorf (KOEND)</option>
<option value="KRONO">Kronobergshed (KRONO)</option>
<option value="LKKU">KUNOVICE (LKKU)</option>
<option value="LECD">LA CERDANYA (LECD)</option>
<option value="LFMG">LA MONTAGNE NOIRE (LFMG)</option>
<option value="LAMOT">La Motte du Caire (LAMOT)</option>
<option value="LFSU">LANGRES Rolampont (LFSU)</option>
<option value="EGHL">LASHAM (EGHL)</option>
<option value="LFRI">LA ROCHE SUR YON Les Ajoncs (LFRI)</option>
<option value="LFOV">LAVAL Entrammes (LFOV)</option>
<option value="LFEL">LE BLANC (LFEL)</option>
<option value="EGHF">LEE ON THE SOLENT (EGHF)</option>
<option value="LFOY">LE HAVRE Saint-Romain (LFOY)</option>
<option value="LFRM">LE MANS Arnage (LFRM)</option>
<option value="LFNZ">LE MAZET DE ROMARIN (LFNZ)</option>
<option value="EKLV">LEMVIG Flyveklub (EKLV)</option>
<option value="LFHP">LE PUY Loudes (LFHP)</option>
<option value="EPLS">LESZNO Strzyzewice (EPLS)</option>
<option value="EDKL">LEVERKUSEN (EDKL)</option>
<option value="EDQL">LICHTENFELS (EDQL)</option>
<option value="LELT">LILLO (LELT)</option>
<option value="EPLU">LUBIN (EPLU)</option>
<option value="EPLR">LUBLIN Radawiec (EPLR)</option>
<option value="LSZO">LUZERN-BEROMUNSTER (LSZO)</option>
<option value="LFHJ">LYON Corbas (LFHJ)</option>
<option value="LFFC">MANTES Cherence (LFFC)</option>
<option value="LFQJ">MAUBEUGE Elesmes (LFQJ)</option>
<option value="EFME">MENKIJARVI (EFME)</option>
<option value="LFNB">MENDE Brenoux (LFNB)</option>
<option value="MFLD">Milfield (MFLD)</option>
<option value="LSMF">MOLLIS (LSMF)</option>
<option value="LFFW">MONTAIGU ST Georges (LFFW)</option>
<option value="LFEM">MONTARGIS Vimory (LFEM)</option>
<option value="YMBT">MONT BEAUTY (YMBT)</option>
<option value="LFNC">MONT DAUPHIN Saint Crepin (LFNC)</option>
<option value="LFNQ">MONT LOUIS La Quillane (LFNQ)</option>
<option value="LSTR">MONTRICHER (LSTR)</option>
<option value="EDPI">MOOSBURG (EDPI)</option>
<option value="LFPU">MORET Episy (LFPU)</option>
<option value="LKMO">MOST (LKMO)</option>
<option value="MOTAL">Motala (MOTAL)</option>
<option value="LFHY">MOULINS Montbeugny (LFHY)</option>
<option value="EDDG">MUNSTER / OSNABRUCK (EDDG)</option>
<option value="MUSB">Musbach (MUSB)</option>
<option value="MYND">Mynd (MYND)</option>
<option value="EDTN">NABERN/TECK (EDTN)</option>
<option value="EBNM">NAMUR - SUARLEE (EBNM)</option>
<option value="LFEZ">NANCY Malzeville (LFEZ)</option>
<option value="FATP">NEW TEMPE (FATP)</option>
<option value="LOGO">NIEDEROBLARN (LOGO)</option>
<option value="LZNI">NITRA (LZNI)</option>
<option value="LFCN">NOGARO (LFCN)</option>
<option value="NHL">North Hill (NHL)</option>
<option value="EFNU">NUMMELA (EFNU)</option>
<option value="NYMP">Nympsfield (NYMP)</option>
<option value="LEOC">OCANA (LEOC)</option>
<option value="LFCO">OLORON Herrere (LFCO)</option>
<option value="NZOA">OMARAMA (NZOA)</option>
<option value="LFLK">OYONNAX Arbent (LFLK)</option>
<option value="LIPU">PADOVA (LIPU)</option>
<option value="UKPAR">PARHAM (UKPAR)</option>
<option value="EDTQ">PATTONVILLE (EDTQ)</option>
<option value="LFHD">PIERRELATTE (LFHD)</option>
<option value="LFRP">PLOERMEL Loyat (LFRP)</option>
<option value="EPKP">POBIEDNIK (EPKP)</option>
<option value="POCK">Pocklington (POCK)</option>
<option value="EPOP">POLSKA NOWA WIES (EPOP)</option>
<option value="PORT">Portmoak (PORT)</option>
<option value="LZPE">PRIEVIDZA (LZPE)</option>
<option value="LFNW">PUIVERT (LFNW)</option>
<option value="LFQA">REIMS Prunay (LFQA)</option>
<option value="LFIL">RION DES LANDES (LFIL)</option>
<option value="LFLO">ROANNE Renaison (LFLO)</option>
<option value="LFHE">ROMANS Saint Paul (LFHE)</option>
<option value="LFYR">ROMORANTIN Pruniers (LFYR)</option>
<option value="LFOP">ROUEN Boos (LFOP)</option>
<option value="UKRUF">RUFFORTH (UKRUF)</option>
<option value="LFPZ">SAINT CYR L'ECOLE (LFPZ)</option>
<option value="LFGP">SAINT FLORENTIN Cheu (LFGP)</option>
<option value="LFIM">SAINT GAUDENS Montrejeau (LFIM)</option>
<option value="LFNL">SAINT MARTIN DE LONDRES (LFNL)</option>
<option value="LFSS">SAINT SULPICE DES LANDES (LFSS)</option>
<option value="LFXB">SAINTES Thenac (LFXB)</option>
<option value="LFNE">SALON Eyguieres (LFNE)</option>
<option value="SALT">Saltby (SALT)</option>
<option value="LISM">SAN MAURO (LISM)</option>
<option value="LECI">SANTA CILIA (LECI)</option>
<option value="LFGU">SARREGUEMINES (LFGU)</option>
<option value="EDTY">SCHWABISCH HALL (EDTY)</option>
<option value="EDLD">SCHWARZE HEIDE (EDLD)</option>
<option value="LFSJ">SEDAN Douzy (LFSJ)</option>
<option value="SEIG">Seighford (SEIG)</option>
<option value="LFNS">SISTERON Vaumeilh (LFNS)</option>
<option value="EKSL">SLAGLILLE (EKSL)</option>
<option value="EHSB">SOESTERBERG (EHSB)</option>
<option value="EDLS">STADTLOHN (EDLS)</option>
<option value="LKSU">SUMPERK (LKSU)</option>
<option value="ESKC">SUNDBRO (ESKC)</option>
<option value="SUTT">Sutton Bank (SUTT)</option>
<option value="UKTAL">TALGARTH (UKTAL)</option>
<option value="LFDT">TARBES Laloubere (LFDT)</option>
<option value="EFTS">TEISKO (EFTS)</option>
<option value="EHTL">TERLET (EHTL)</option>
<option value="EHTE">TEUGE (EHTE)</option>
<option value="UKPRK">THE PARK (UKPRK)</option>
<option value="LIDH">THIENE (LIDH)</option>
<option value="LFCT">THOUARS (LFCT)</option>
<option value="TIRS">Tirschenreuth (TIRS)</option>
<option value="LFIT">TOULOUSE Bourg Saint Bernard (LFIT)</option>
<option value="EBTY">TOURNAI/MAUBRAY (EBTY)</option>
<option value="LFJT">TOURS Le Louroux (LFJT)</option>
<option value="LFQB">TROYES Barberey (LFQB)</option>
<option value="TRUE">True (TRUE)</option>
<option value="ELUS">Useldange (ELUS)</option>
<option value="UKUSK">USK (UKUSK)</option>
<option value="LFLU">VALENCE Chabeuil (LFLU)</option>
<option value="VEEN">Veendam (VEEN)</option>
<option value="VEIL">Vielbrunn (VEIL)</option>
<option value="LFHV">VILLEFRANCHE Tarare (LFHV)</option>
<option value="LFNF" selected="selected">VINON (LFNF)</option>
<option value="EDEW">WALLDURN (EDEW)</option>
<option value="EBWE">WEELDE (EBWE)</option>
<option value="EDQW">WEIDEN-OPF (EDQW)</option>
<option value="EDNW">WEISSENHORN (EDNW)</option>
<option value="EDLX">WESEL (EDLX)</option>
<option value="WEST">Weston on the green (WEST)</option>
<option value="EHWO">WOENSDRECHT (EHWO)</option>
<option value="EGTB">Wycombe Air Park/Booker (EGTB)</option>
<option value="LSGY">YVERDON-LES-BAINS (LSGY)</option>
<option value="LKZM">ZAMBERK (LKZM)</option>
<option value="EPZR">ZAR (EPZR)</option>
<option value="EBZR">ZOERSEL (EBZR)</option>
</select>

<label for="d" class="sr-only">Date</label>
<INPUT TYPE="text" NAME="d" id="ddate" VALUE="" SIZE=15 class="form-control date">

<label for="s" class="sr-only">Altimeter setting</label>
<select name="s" size="1" class="form-control">
<option value="QFE">QFE</option>
<option value="QNH">QNH</option>
</select>

<label for="u" class="sr-only">Units</label>
<select name="u" size="1" class="form-control"><option value="m">Meters<option value="f">Feet</select>

<label for="z" class="sr-only">Time Zone</label>
<select name="z" id="tz" size="1" class="form-control">
  <option value="-12">GMT-12:00</option>
  <option value="-11">GMT-11:00</option>
  <option value="-10">GMT-10:00</option>
  <option value="-9.5">GMT-09:30</option>
  <option value="-9">GMT-09:00</option>
  <option value="-8">GMT-08:00</option>
  <option value="-7">GMT-07:00</option>
  <option value="-6">GMT-06:00</option>
  <option value="-5">GMT-05:00</option>
  <option value="-4.5">GMT-04:30</option>
  <option value="-4">GMT-04:00</option>
  <option value="-3.5">GMT-03:30</option>
  <option value="-3">GMT-03:00</option>
  <option value="-2">GMT-02:00</option>
  <option value="-1">GMT-01:00</option>
  <option value="0">GMT</option>
  <option value="1" selected="selected">GMT+01:00</option>
  <option value="2">GMT+02:00</option>
  <option value="3">GMT+03:00</option>
  <option value="3.5">GMT+03:30</option>
  <option value="4">GMT+04:00</option>
  <option value="4.5">GMT+04:30</option>
  <option value="5">GMT+05:00</option>
  <option value="5.5">GMT+05:30</option>
  <option value="5.75">GMT+05:45</option>
  <option value="6">GMT+06:00</option>
  <option value="6.5">GMT+06:30</option>
  <option value="7">GMT+07:00</option>
  <option value="8">GMT+08:00</option>
  <option value="8.75">GMT+08:45</option>
  <option value="9">GMT+09:00</option>
  <option value="9.5">GMT+09:30</option>
  <option value="10">GMT+10:00</option>
  <option value="10.5">GMT+10:30</option>
  <option value="11">GMT+11:00</option>
  <option value="11.5">GMT+11:30</option>
  <option value="12">GMT+12:00</option>
  <option value="12.75">GMT+12:45</option>
  <option value="13">GMT+13:00</option>
  <option value="14">GMT+14:00</option>
  </select>

  <BR><br>
  <input type="submit" value="Submit">
  </FORM>
<br>
<IMG SRC="../../images/ogn-logo-ani.gif">

				</div>
			</section>
		</div>

	</div>
	<footer class="row">
		<?php $this->load->view('footer'); ?>
	</footer>
	<!-- /.container -->
    <?= script(base_url() . '/js/project.js')?>

</body>
</html>
