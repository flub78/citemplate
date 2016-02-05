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

		<div class="row"
			<nav class="col-sm-1"></nav>
			<section class="col-sm-11">
				<h1><?php echo isset($title) ? $title : ''; ?></h1>
				<p class="error"> <?php echo isset($error) ? $error : ''; ?></p>

				<div class="row">
					<article class="col-sm-12 row">
						<div class="jumbotron">

							<p><?php echo isset($message) ? $message : ''; ?></p>
<FORM action="index.php" ENCTYPE="multipart/form-data" method="get"><INPUT id="tid" type="hidden" name="t" value="0"><TABLE><TR><TD>Airfield:</TD><TD><select name="a" size="1"><option value="LFOI">ABBEVILLE (LFOI)<option value="ABOY">Aboyne (ABOY)<option value="LOXA">AIGEN IM ENNSTAL (LOXA)<option value="LFDA">AIRE SUR L'ADOUR (LFDA)<option value="LFJR">ANGERS Marce (LFJR)<option value="LFCH">ARCACHON La teste de buch (LFCH)<option value="LFEG">ARGENTON SUR CREUSE (LFEG)<option value="EKAB">ARNBORG (EKAB)<option value="LFNJ">ASPRES SUR BUECH (LFNJ)<option value="ASTO">Aston Down (ASTO)<option value="LFHO">AUBENAS (LFHO)<option value="LFJF">AUBENASSON (LFJF)<option value="LFDH">AUCH (LFDH)<option value="EDMA">AUGSBURG (EDMA)<option value="LFLA">AUXERRE Branches (LFLA)<option value="LFNT">AVIGNON Pujaut (LFNT)<option value="YBSS">BACCHUS MARSH (YBSS)<option value="EDRA">Bad Neuenahr Ahrweiler (EDRA)<option value="LFCB">BAGNERES DE LUCHON (LFCB)<option value="LFFL">BAILLEAU Armenonville (LFFL)<option value="EBKH">BALEN KEIHEUVEL (EBKH)<option value="LFMR">BARCELONNETTE Saint Pons (LFMR)<option value="LLBS">BE'ER SHEVA Teyman (LLBS)<option value="LFGG">BELFORT Chaux (LFGG)<option value="LSTB">BELLECHASSE (LSTB)<option value="YBLA">BENALLA (YBLA)<option value="LSGB">BEX (LSGB)<option value="LSZF">BIRRFELD (LSZF)<option value="EDMC">BLAUBEUREN (EDMC)<option value="EDKB">BONN-HANGELAR (EDKB)<option value="ESSD">BORLANGE (ESSD)<option value="LFHS">BOURG Ceyzeriat (LFHS)<option value="EBBT">BRASSCHAAT (EBBT)<option value="EDVE">BRAUNSCHWEIG-WOLFSBURG (EDVE)<option value="LFFB">BUNO BONNEVAUX (LFFB)<option value="LFYG">CAMBRAI Niergnies (LFYG)<option value="LFNH">CARPENTRAS (LFNH)<option value="LJCL">CELJE (LJCL)<option value="EDVC">CELLE-ARLOH (EDVC)<option value="CELL">Celle-Scheuen (CELL)<option value="LFQK">CHALON Ecury sur Coole (LFQK)<option value="LFLE">CHAMBERY Challes-Les-Eaux (LFLE)<option value="LFOR">CHARTRES Champhol (LFOR)<option value="LFMX">CHATEAU ARNOUX Saint Auban (LFMX)<option value="UKCHP">CHIPPING (UKCHP)<option value="LFGA">COLMAR Houssen (LFGA)<option value="LFAD">COMPIEGNE Margny (LFAD)<option value="LFID">CONDOM Valence sur Baise (LFID)<option value="LFPK">COULOMMIERS Voisins (LFPK)<option value="LSZJ">COURTELARY (LSZJ)<option value="ESKD">DALA Jarna (ESKD)<option value="EHDL">DEELEN (EHDL)<option value="DVOO">DeVoorst (DVOO)<option value="EBDT">DIEST SCHAFFEN (EBDT)<option value="LFGI">DIJON Darois (LFGI)<option value="LIVD">DOBBIACO (LIVD)<option value="EDTD">DONAUESCHINGEN (EDTD)<option value="DUNS">Dunstable (DUNS)<option value="LKDK">DVUR KRALOVE (LKDK)<option value="EAST">Easterton (EAST)<option value="ENSM">ELVERUM/STARMOEN (ENSM)<option value="ENEMO">Enemonzo (ENEMO)<option value="EDNE">ERBACH (EDNE)<option value="ESSC">Eskilstuna (ESSC)<option value="LFAS">FALAISE Monts-d'Eraines (LFAS)<option value="LFMF">FAYENCE (LFMF)<option value="LOKF">Feldkirchen-Ossiacher See (LOKF)<option value="LIPF">FERRARA (LIPF)<option value="UKFES">Feshiebridge (UKFES)<option value="LFFK">FONTENAY LE COMTE (LFFK)<option value="LEFM">FUENTEMILANOS (LEFM)<option value="LFNA">GAP Tallard (LFNA)<option value="EDPT">GERSTETTEN (EDPT)<option value="EHGR">GILZE-RIJEN (EHGR)<option value="EDLG">GOCH-ASPERDEN (EDLG)<option value="EDSG">GRABENSTETTEN (EDSG)<option value="GRAN">Gransden Lodge Airfield (GRAN)<option value="LOWG">GRAZ (LOWG)<option value="LFLG">GRENOBLE Le Versoud (LFLG)<option value="HABE">Habere Poche (HABE)<option value="EDST">HAHNWEIDE (EDST)<option value="EGWN">HALTON (EGWN)<option value="LSZN">HAUSEN AM ALBIS (LSZN)<option value="EHHV">HILVERSUM (EHHV)<option value="EDVH">HODENHAGEN (EDVH)<option value="EHHO">HOOGEVEEN (EHHO)<option value="HOYA">Hoya (HOYA)<option value="HUSB">Husbands Bosworth (HUSB)<option value="EFHV">HYVINKAA (EFHV)<option value="ISER">Iserlohn (ISER)<option value="LFHA">ISSOIRE Le Broc (LFHA)<option value="LFEK">ISSOUDUN Le Fay (LFEK)<option value="LFIX">ITXASSOU (LFIX)<option value="EFJM">JAMIJARVI (EFJM)<option value="ESSX">JOHANNISBERG (ESSX)<option value="LFFJ">JOINVILLE Mussey (LFFJ)<option value="EDWJ">JUIST (EDWJ)<option value="EKKL">KALUNDBORG (EKKL)<option value="KAME">Kamen-Heeren (KAME)<option value="EGBP">KEMBLE (EGBP)<option value="FYKH">Kiripotib (FYKH)<option value="KIRT">Kirton in Lindsey (KIRT)<option value="EDCI">KLIX (EDCI)<option value="KOEND">Koenigsdorf (KOEND)<option value="KRONO">Kronobergshed (KRONO)<option value="LKKU">KUNOVICE (LKKU)<option value="LECD">LA CERDANYA (LECD)<option value="LFMG">LA MONTAGNE NOIRE (LFMG)<option value="LAMOT">La Motte du Caire (LAMOT)<option value="LFSU">LANGRES Rolampont (LFSU)<option value="EGHL">LASHAM (EGHL)<option value="LFRI">LA ROCHE SUR YON Les Ajoncs (LFRI)<option value="LFOV">LAVAL Entrammes (LFOV)<option value="LFEL">LE BLANC (LFEL)<option value="EGHF">LEE ON THE SOLENT (EGHF)<option value="LFOY">LE HAVRE Saint-Romain (LFOY)<option value="LFRM">LE MANS Arnage (LFRM)<option value="LFNZ">LE MAZET DE ROMARIN (LFNZ)<option value="EKLV">LEMVIG Flyveklub (EKLV)<option value="LFHP">LE PUY Loudes (LFHP)<option value="EPLS">LESZNO Strzyzewice (EPLS)<option value="EDKL">LEVERKUSEN (EDKL)<option value="EDQL">LICHTENFELS (EDQL)<option value="LELT">LILLO (LELT)<option value="EPLU">LUBIN (EPLU)<option value="EPLR">LUBLIN Radawiec (EPLR)<option value="LSZO">LUZERN-BEROMUNSTER (LSZO)<option value="LFHJ">LYON Corbas (LFHJ)<option value="LFFC">MANTES Cherence (LFFC)<option value="LFQJ">MAUBEUGE Elesmes (LFQJ)<option value="EFME">MENKIJARVI (EFME)<option value="LFNB">MENDE Brenoux (LFNB)<option value="MFLD">Milfield (MFLD)<option value="LSMF">MOLLIS (LSMF)<option value="LFFW">MONTAIGU ST Georges (LFFW)<option value="LFEM">MONTARGIS Vimory (LFEM)<option value="YMBT">MONT BEAUTY (YMBT)<option value="LFNC">MONT DAUPHIN Saint Crepin (LFNC)<option value="LFNQ">MONT LOUIS La Quillane (LFNQ)<option value="LSTR">MONTRICHER (LSTR)<option value="EDPI">MOOSBURG (EDPI)<option value="LFPU">MORET Episy (LFPU)<option value="LKMO">MOST (LKMO)<option value="MOTAL">Motala (MOTAL)<option value="LFHY">MOULINS Montbeugny (LFHY)<option value="EDDG">MUNSTER / OSNABRUCK (EDDG)<option value="MUSB">Musbach (MUSB)<option value="MYND">Mynd (MYND)<option value="EDTN">NABERN/TECK (EDTN)<option value="EBNM">NAMUR - SUARLEE (EBNM)<option value="LFEZ">NANCY Malzeville (LFEZ)<option value="FATP">NEW TEMPE (FATP)<option value="LOGO">NIEDEROBLARN (LOGO)<option value="LZNI">NITRA (LZNI)<option value="LFCN">NOGARO (LFCN)<option value="NHL">North Hill (NHL)<option value="EFNU">NUMMELA (EFNU)<option value="NYMP">Nympsfield (NYMP)<option value="LEOC">OCANA (LEOC)<option value="LFCO">OLORON Herrere (LFCO)<option value="NZOA">OMARAMA (NZOA)<option value="LFLK">OYONNAX Arbent (LFLK)<option value="LIPU">PADOVA (LIPU)<option value="UKPAR">PARHAM (UKPAR)<option value="EDTQ">PATTONVILLE (EDTQ)<option value="LFHD">PIERRELATTE (LFHD)<option value="LFRP">PLOERMEL Loyat (LFRP)<option value="EPKP">POBIEDNIK (EPKP)<option value="POCK">Pocklington (POCK)<option value="EPOP">POLSKA NOWA WIES (EPOP)<option value="PORT">Portmoak (PORT)<option value="LZPE">PRIEVIDZA (LZPE)<option value="LFNW">PUIVERT (LFNW)<option value="LFQA">REIMS Prunay (LFQA)<option value="LFIL">RION DES LANDES (LFIL)<option value="LFLO">ROANNE Renaison (LFLO)<option value="LFHE">ROMANS Saint Paul (LFHE)<option value="LFYR">ROMORANTIN Pruniers (LFYR)<option value="LFOP">ROUEN Boos (LFOP)<option value="UKRUF">RUFFORTH (UKRUF)<option value="LFPZ">SAINT CYR L'ECOLE (LFPZ)<option value="LFGP">SAINT FLORENTIN Cheu (LFGP)<option value="LFIM">SAINT GAUDENS Montrejeau (LFIM)<option value="LFNL">SAINT MARTIN DE LONDRES (LFNL)<option value="LFSS">SAINT SULPICE DES LANDES (LFSS)<option value="LFXB">SAINTES Thenac (LFXB)<option value="LFNE">SALON Eyguieres (LFNE)<option value="SALT">Saltby (SALT)<option value="LISM">SAN MAURO (LISM)<option value="LECI">SANTA CILIA (LECI)<option value="LFGU">SARREGUEMINES (LFGU)<option value="EDTY">SCHWABISCH HALL (EDTY)<option value="EDLD">SCHWARZE HEIDE (EDLD)<option value="LFSJ">SEDAN Douzy (LFSJ)<option value="SEIG">Seighford (SEIG)<option value="LFNS">SISTERON Vaumeilh (LFNS)<option value="EKSL">SLAGLILLE (EKSL)<option value="EHSB">SOESTERBERG (EHSB)<option value="EDLS">STADTLOHN (EDLS)<option value="LKSU">SUMPERK (LKSU)<option value="ESKC">SUNDBRO (ESKC)<option value="SUTT">Sutton Bank (SUTT)<option value="UKTAL">TALGARTH (UKTAL)<option value="LFDT">TARBES Laloubere (LFDT)<option value="EFTS">TEISKO (EFTS)<option value="EHTL">TERLET (EHTL)<option value="EHTE">TEUGE (EHTE)<option value="UKPRK">THE PARK (UKPRK)<option value="LIDH">THIENE (LIDH)<option value="LFCT">THOUARS (LFCT)<option value="TIRS">Tirschenreuth (TIRS)<option value="LFIT">TOULOUSE Bourg Saint Bernard (LFIT)<option value="EBTY">TOURNAI/MAUBRAY (EBTY)<option value="LFJT">TOURS Le Louroux (LFJT)<option value="LFQB">TROYES Barberey (LFQB)<option value="TRUE">True (TRUE)<option value="ELUS">Useldange (ELUS)<option value="UKUSK">USK (UKUSK)<option value="LFLU">VALENCE Chabeuil (LFLU)<option value="VEEN">Veendam (VEEN)<option value="VEIL">Vielbrunn (VEIL)<option value="LFHV">VILLEFRANCHE Tarare (LFHV)<option value="LFNF">VINON (LFNF)<option value="EDEW">WALLDURN (EDEW)<option value="EBWE">WEELDE (EBWE)<option value="EDQW">WEIDEN-OPF (EDQW)<option value="EDNW">WEISSENHORN (EDNW)<option value="EDLX">WESEL (EDLX)<option value="WEST">Weston on the green (WEST)<option value="EHWO">WOENSDRECHT (EHWO)<option value="EGTB">Wycombe Air Park/Booker (EGTB)<option value="LSGY">YVERDON-LES-BAINS (LSGY)<option value="LKZM">ZAMBERK (LKZM)<option value="EPZR">ZAR (EPZR)<option value="EBZR">ZOERSEL (EBZR)</select></TD></TR><TR><TD>Date</TD><TD>
  		<SCRIPT LANGUAGE="JavaScript" ID="jscal1xx">
			var cal1xx = new CalendarPopup("testdiv1");
			cal1xx.showNavigationDropdowns();
			</SCRIPT>
			<INPUT TYPE="text" NAME="d" id="ddate" VALUE="" SIZE=15>
			<A HREF="#" onClick="cal1xx.select(document.forms[0].d,'anchor1xx','dd-MM-yyyy'); return false;" TITLE="cal1xx.select(document.forms[0].d,'anchor1xx','dd-MM-yyyy'); return false;" NAME="anchor1xx" ID="anchor1xx">select</A>
			</TD></TR><TR><TD>Altimeter setting</TD><TD><select name="s" size="1"><option value="QFE">QFE<option value="QNH">QNH</select></TD></TR><TR><TD>Units</TD><TD><select name="u" size="1"><option value="m">Meters<option value="f">Feet</select></TD></TR><TR><TD>Time Zone</TD><TD><select name="z" id="tz" size="1">
  <option value="-12">GMT-12:00
  <option value="-11">GMT-11:00
  <option value="-10">GMT-10:00
  <option value="-9.5">GMT-09:30
  <option value="-9">GMT-09:00
  <option value="-8">GMT-08:00
  <option value="-7">GMT-07:00
  <option value="-6">GMT-06:00
  <option value="-5">GMT-05:00
  <option value="-4.5">GMT-04:30
  <option value="-4">GMT-04:00
  <option value="-3.5">GMT-03:30
  <option value="-3">GMT-03:00
  <option value="-2">GMT-02:00
  <option value="-1">GMT-01:00
  <option value="0">GMT
  <option value="1">GMT+01:00
  <option value="2">GMT+02:00
  <option value="3">GMT+03:00
  <option value="3.5">GMT+03:30
  <option value="4">GMT+04:00
  <option value="4.5">GMT+04:30
  <option value="5">GMT+05:00
  <option value="5.5">GMT+05:30
  <option value="5.75">GMT+05:45
  <option value="6">GMT+06:00
  <option value="6.5">GMT+06:30
  <option value="7">GMT+07:00
  <option value="8">GMT+08:00
  <option value="8.75">GMT+08:45
  <option value="9">GMT+09:00
  <option value="9.5">GMT+09:30
  <option value="10">GMT+10:00
  <option value="10.5">GMT+10:30
  <option value="11">GMT+11:00
  <option value="11.5">GMT+11:30
  <option value="12">GMT+12:00
  <option value="12.75">GMT+12:45
  <option value="13">GMT+13:00
  <option value="14">GMT+14:00
  </select>
  </TABLE><BR><input type="submit" value="Submit">
  </FORM>
<br>
<IMG SRC="../../images/ogn-logo-ani.gif">
						</div>

					</article>
				</div>
			</section>
		</div>

	</div>
	<footer class="row">
		<?php $this->load->view('footer'); ?>
	</footer>
	<!-- /.container -->

</body>
</html>
