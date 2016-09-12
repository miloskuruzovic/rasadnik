-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2016 at 01:10 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rasadnik`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `user_login`(IN i_email VARCHAR(255), IN i_pass VARCHAR(255))
BEGIN

DECLARE jaka_lozinka VARCHAR(255);
SET jaka_lozinka = i_pass + '9:3785G11i|Cn2u';

SELECT * FROM korisnici WHERE email = i_email AND lozinka = MD5(jaka_lozinka) LIMIT 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_reg`(IN i_email VARCHAR(255), IN i_pass VARCHAR(255), IN i_ime VARCHAR(255), IN i_prezime VARCHAR(255), IN i_adresa VARCHAR(255), IN i_p_broj VARCHAR(8), IN i_grad VARCHAR(45), IN i_ip VARCHAR(20))
BEGIN

DECLARE provera INT;
DECLARE jaka_lozinka VARCHAR(255);
DECLARE md5_lozinka VARCHAR(50);

SELECT COUNT(korisnik_id) FROM korisnici WHERE email = i_email INTO provera;

IF provera > 0 THEN
	SELECT 'Vec postoji korisnik sa unetim emailom!' as 'ODGOVOR';
ELSE
	SET jaka_lozinka = i_pass + '9:3785G11i|Cn2u';
	SET md5_lozinka = MD5(jaka_lozinka);
	INSERT INTO korisnici VALUES (null, i_email, md5_lozinka, i_ime, i_prezime, i_adresa, i_p_broj, i_grad, NOW(), i_ip, 0);
END IF;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE IF NOT EXISTS `kategorije` (
  `kategorija_id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_kategorije` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`kategorija_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`kategorija_id`, `naziv_kategorije`, `status`) VALUES
(1, 'Drveće', 1),
(2, 'Žbunje', 1),
(3, 'Cveće', 1),
(4, 'Puzavice', 1),
(5, 'Ukrasna trava', 1);

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE IF NOT EXISTS `komentari` (
  `komentar_id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik` int(11) DEFAULT NULL,
  `sadnica` int(11) DEFAULT NULL,
  `komentar` text COLLATE utf8_unicode_ci,
  `vreme` datetime DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`komentar_id`),
  KEY `fk_korisnik_id_idx` (`korisnik`),
  KEY `fk_sadnica_id_idx` (`sadnica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`komentar_id`, `korisnik`, `sadnica`, `komentar`, `vreme`, `ip`, `status`) VALUES
(1, 10, 5, 'test', '2016-07-14 20:54:41', '127.0.0.1', 1),
(2, 10, 5, 'drugi komentar,ajde da bude malo duzi', '2016-07-14 21:45:57', '127.0.0.1', 1),
(3, 12, 5, 'Kometar kroz formu', '2016-07-14 23:18:58', '::1', 1),
(4, 12, 5, 'sad radi vrhunski', '2016-07-14 23:21:34', '::1', 1),
(5, 12, 7, 'odlican artikal', '2016-07-15 10:39:26', '::1', 1),
(7, 12, 25, 'Dobar za celulit!!', '2016-07-22 01:12:19', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `korisnik_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lozinka` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ime` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prezime` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_broj` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grad` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_datum` datetime DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`korisnik_id`, `email`, `lozinka`, `ime`, `prezime`, `adresa`, `p_broj`, `grad`, `reg_datum`, `ip`, `status`) VALUES
(10, 'milos@strong.com', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'Milos', 'Kuruzovic', 'Zvezdarska 4', '11060', 'Beograd', '2016-06-13 14:17:18', '127.0.0.1', 2),
(11, 'registracija@test.com', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'Tester', 'lalala', 'Adresa 123', '11000', 'Beograd', '2016-06-13 14:56:18', '::1', 1),
(12, 'mvc@register.com', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'MVC', 'Pattern', 'Zvezdarska 4', '11000', 'Belgrade', '2016-06-19 10:22:35', '::1', 2),
(13, 'novitest@test.com', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'novi', 'tester', 'Zvezdarska 4', '11000', 'Belgrade', '2016-06-21 10:55:43', '::1', 1),
(15, 'mail@mail.com', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'prvi', 'status0', 'Zvezdarska 4', '11000', 'Beograd', '2016-07-12 12:44:15', '::1', 0),
(16, 'mail@ninja.com', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'ninja', 'ninjitsu', 'meh', '10001', 'tokio', '2016-07-13 15:37:10', '::1', 0),
(21, 'miloskuruzovic@gmail.com', '45c48cce2e2d7fbdea1afc51c7c6ad26', 'Milos', 'Kuruzovic', 'Zvezdarska 4', '11000', 'Belgrade', '2016-07-19 13:34:24', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `narudzbenice`
--

CREATE TABLE IF NOT EXISTS `narudzbenice` (
  `narudzbenica_id` int(11) NOT NULL AUTO_INCREMENT,
  `korisnik` int(11) DEFAULT NULL,
  `sadnica` int(11) DEFAULT NULL,
  `naziv_sadnice` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kolicina` int(11) DEFAULT NULL,
  `cena` decimal(7,2) DEFAULT NULL,
  `datum_narucivanja` datetime DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `n_status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`narudzbenica_id`),
  KEY `fk_korisnik_idx` (`korisnik`),
  KEY `fk_sadnica_idx` (`sadnica`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Dumping data for table `narudzbenice`
--

INSERT INTO `narudzbenice` (`narudzbenica_id`, `korisnik`, `sadnica`, `naziv_sadnice`, `kolicina`, `cena`, `datum_narucivanja`, `ip`, `status`, `n_status`) VALUES
(27, 10, 4, 'Zbun po super ceni', 1, '700.00', '2016-06-13 14:25:58', '::1', 0, 5),
(28, 10, 8, 'Drvo', 5, '2775.00', '2016-06-13 14:26:23', '::1', 1, 2),
(29, 10, 6, 'Cvece na akciji', 1, '659.00', '2016-06-13 15:16:20', '::1', 1, 5),
(30, 10, 3, 'Drvo na akciji', 1, '600.00', '2016-06-13 15:16:40', '::1', 1, 1),
(32, 10, 5, 'Ukrasna trava(na primer) na akciji', 1, '1050.00', '2016-06-14 23:12:20', '::1', 0, 5),
(33, 11, 2, 'Zbun na akciji', 4, '2000.00', '2016-06-14 23:44:10', '::1', 1, 4),
(34, 11, 13, 'Cvet ', 6, '894.00', '2016-06-14 23:44:22', '::1', 0, 5),
(35, 11, 4, 'Zbun po super ceni', 1, '700.00', '2016-06-15 23:09:39', '::1', 1, 2),
(36, 11, 7, 'Puzavica(recimo) na akciji', 1, '889.00', '2016-06-17 00:40:20', '::1', 1, 2),
(37, 11, 7, 'Puzavica(recimo) na akciji', 1, '889.00', '2016-06-19 12:55:28', '::1', 1, 2),
(38, 11, 13, 'Cvet ', 1, '149.00', '2016-06-20 22:10:19', '::1', 0, 5),
(39, 11, 9, 'Ukrasna trava', 1, '300.00', '2016-06-20 22:12:20', '::1', 1, 3),
(40, 11, 5, 'Ukrasna trava(na primer) na akciji', 1, '1050.00', '2016-06-20 22:13:56', '::1', 1, 2),
(41, 11, 16, 'Puzavica,africka', 1, '450.00', '2016-06-20 22:14:09', '::1', 0, 5),
(42, 11, 13, 'Cvet ', 1, '149.00', '2016-06-20 22:18:34', '::1', 1, 2),
(44, 11, 15, 'Cvet meh', 1, '250.00', '2016-06-20 22:22:04', '::1', 1, 1),
(45, 13, 2, 'Zbun na akciji', 3, '1500.00', '2016-06-21 10:56:37', '::1', 1, 2),
(46, 13, 12, 'Zbun', 10, '5600.00', '2016-06-21 10:56:52', '::1', 1, 2),
(47, 13, 11, 'Palma', 3, '3270.00', '2016-06-21 10:57:10', '::1', 1, 1),
(48, 12, 15, 'Cvet meh', 2, '500.00', '2016-06-21 22:44:50', '::1', 0, 5),
(49, 21, 32, 'Forzicija', 1, '320.00', '2016-07-22 12:57:25', '::1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sadnice`
--

CREATE TABLE IF NOT EXISTS `sadnice` (
  `sadnica_id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kategorija` int(11) DEFAULT NULL,
  `cena` decimal(8,2) DEFAULT NULL,
  `stanje` int(11) DEFAULT NULL,
  `akcija` tinyint(1) DEFAULT NULL,
  `opis` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`sadnica_id`),
  KEY `fk_kategorija_idx` (`kategorija`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Dumping data for table `sadnice`
--

INSERT INTO `sadnice` (`sadnica_id`, `naziv`, `kategorija`, `cena`, `stanje`, `akcija`, `opis`, `status`) VALUES
(2, 'Zbun na akciji', 2, '500.00', 11, 1, 'Zbun,super cena', 0),
(3, 'Drvo na akciji', 1, '600.00', 20, 1, 'Drvo,super cena', 0),
(4, 'Zbun po super ceni', 2, '700.00', 9, 1, 'Zbun,povoljno', 0),
(5, 'Ukrasna trava(na primer) na akciji', 5, '1050.00', 18, 1, 'Ukrsana trava,super cena', 0),
(6, 'Cvece na akciji', 3, '659.00', 25, 1, 'Cvece,super cena', 0),
(7, 'Puzavica(recimo) na akciji', 4, '889.00', 12, 1, 'Puzavica,povoljno', 0),
(8, 'Drvo', 1, '555.00', 33, 0, 'Mozda neka palma', 0),
(9, 'Ukrasna trava', 5, '300.00', 49, 0, 'Ukrasna trava u svrhe testiranja', 0),
(10, 'Puzavica', 4, '439.00', 26, 0, 'Puzavica jer je visoka', 0),
(11, 'Palma', 1, '1090.00', 14, 0, 'Africka palma', 0),
(12, 'Zbun', 2, '560.00', 31, 0, 'Zbun,egzoticni', 0),
(13, 'Cvet ', 3, '149.00', 16, 0, 'Cvet u svrhe testiranja', 0),
(14, 'Palma mini', 1, '1200.00', 20, 0, 'Mini palma maxi egzotika', 0),
(15, 'Cvet meh', 3, '250.00', 10, 0, 'Evo i ovo je cvet', 0),
(16, 'Puzavica,africka', 4, '450.00', 22, 0, 'Puzavica jer ih imam najmanje', 0),
(17, 'Roze Mimoza', 1, '2100.00', 20, 0, 'Listopadno, 5-10 m visoko drvo, široko razgranate krošnje. U vreme cvetanja, ( VI i VII mesec), izuzetno je dekorativna i interesantna. Izdržava temperature i do -15°C. Treba je uzgajati na sunčanim i zaklonjenim mestima, a traži duboko, rastresito i hranjivo zemljište.', 1),
(19, 'Japanski Javor', 1, '1200.00', 33, 1, 'Japanski javori se mogu videti u mnogim vrtovima. Retke su vrste drveća koje mogu kroz celu godinu pružati takav vizuelni užitak kao japanski javor.Postoje različite vrste ovog drveća, ali uopšteno pojam japanski javor se odnosi na ACER JAPONICUM i ACER PALMATUM. Japanci su, koristeći prirodnu raznolikost i genetsku varijabilnost, stvorili mnoge kultivare i dali su im poetična imena koja je skoro nemoguće prevesti.U prirodi japanski javori rastu i do 7 metara.', 1),
(20, 'Pampas Trava', 5, '120.00', 5, 0, 'Visoka ukrasna trava', 1),
(21, 'Troprsta Lozica', 4, '570.00', 22, 0, 'Parthenocissus tricuspidata - Trolisna lozica, u narodu poznata i kao partenocisus, devojačka ili troprsta lozica potiče iz Severne Amerike. Nezahtevna puzavica koja nema prohteva oko uzgajanja, kao ni svoja „rođaka“ petoprsta lozica. List je izdeljen na tri režnja, pa otud naziv troprsta ili trolisna loza. Cveta sitnim cvetovima, a plodovi nalik plodovima borovnice su grupisani u manje grozdove. Što se tiče brzine rasta, može se reći da spada u brzorastuće puzavice. Za oslonac je potrebno obezbediti čvrstu potporu npr. zid, ograda… Za podlogu se hvata takozvanim pipcima, koja se bukvalno lepi za oslonac, tako da joj nije potrebna bilo kakva dodatna mreža ili merdevine. Uporedivši je sa petoprstom koja se više grana, troprsta raste u dužinu/visinu pa je preporučljivo orezivanje kako bi se postigao odgovarajući efekat.', 1),
(22, 'Japanska Dunja', 2, '300.00', 22, 0, 'Japanska dunja  je specifični vesnik proleća, i može dostići visinu od jednog do tri metra a raste u vidu trnovitog grma. Sjajni, tamnozeleni i blago nazubljeni listovi po ivicama, naizmenično su raspoređeni i jednostavni dok su cvetovi veličine od 3 do 5 cm u prečniku, imaju pet latica i obično su obojeno narandžasto-crvenim nijansama, dok su redje one sa cvetovima bele i bledo ružičaste boje. Noviji kultivari imaju duple cvetove i prijatan nežan miris.', 1),
(23, 'Orlovi nokti', 4, '790.00', 44, 0, 'Listopadna biljka lonicera dostiže visinu do 4 a neke čak i do 10 metara. Donji listovi su elipsoidni dok su gornji listovi međusobno srasli. Cvetovi današnjih varijeteta mogu biti u različitim bojama - od ružičasto-crvene i belo-žute kombinacije, pa sve do narandžastih, jarkih cvasti. Najlepši miris lonicera širi u junu kad su cvasti potpuno otvorene. Postoje dve različite vrste - žbunasta lonicera, koja je nešto niža i puzavica, koja se najviše koristi za obrastanje zidova, ograda i pergola. Njoj treba obezbediti dobar oslonac.', 1),
(24, 'Plava kiša', 4, '550.00', 56, 1, 'Visterija-plava kiša je veličanstvena listopadna puzavica. Latinski naziv za ovu biljku je WISTERIA SINENSIS, a zovu je još i GLICINIJA.Može da dostigne visinu od 15 do 20 m, pa čak ima i primera gde je i viša od 20 m. Njen ukras je cvet koji se javlja u krupnim visećim grozdovima. Otuda i naziv za ovu biljku „plava kiša“. Postoji i visterija u beloj,u ružičastoj boji,i u svim nijansama između ove tri boje. Cvetovi su joj opojnog mirisa i javljaju se od aprila do juna meseca. Izuzetno mirisni cvetovi privlače pčele i druge insekte koji ne mogu odoleti medenom nektaru ove biljke. Nakon cvetanja, na mestima gde je bio cvet, formiraju se duge i plišane maune pune semena. One se zadržavaju na granama tokom zime, pa predstavljaju dodatni ukras ovoj penjačici.', 1),
(25, 'Bršljan', 4, '150.00', 78, 0, 'Ovo je zimzelena drvenasta biljka koja najčešće krasi zidove i ograde. Voli senku, eventualno polusenku, mada i na suncu izgleda lepo. Listovi su joj kožasti, sa lica mogu biti tamno zeleni ili prošarani kremasto belim ili srebrnastim prugama. Postoji više vrsta ove biljke. Mogu se saditi i kao pokrivači tla, izuzetno lepo izgleda pored vodenih površina.', 1),
(26, 'Breza', 1, '800.00', 155, 0, 'Drvo koji dostiže visinu do 20 m i širinu do 8 m. Starije grane su uspravne, a mlade su viseće. Svetlo zeleni listovi u jesen dobijaju zlatno žutu boju. U martu, pre cvetanja krase je žuto-zelene rese. Tokom zime, takodje je dekorativna, jer joj je kora na stablu i starijim granama potpuno bela. Sadnice u prodaji su visine 250-300 cm.', 1),
(27, 'Crvenolisni Javor', 1, '2000.00', 34, 0, 'Crvenolisni javor sa širokom krošnjom koji raste u visinu 6-7 m. List mu je crvene boje tokom cele sezone, s tim što menja intenzitet boje tokom godine. Drvo cveta u proleće neobičnim žuto-zelenim cvetićima. Uspeva na svakoj vrsti tla, mada će bolje napredovati na tlu koje je bogato humusom. Voli sunčani položaj. Idealno drvo za hlad u manjim dvorištima. U prodaji je sadnica visine 2,5 m.', 1),
(28, 'Kovrdžava vrba', 1, '650.00', 15, 0, 'Dostiže visinu do 15 m, a širina krošnje je i do 7 m. Listovi su svetlo zeleni, a u jesen limun žuti. Sve grane su izuvijane i isprepletane, kao i njeni listovi, što ovu biljku čini jedinstvenom.U zimskom periodu je posebno dekorativna. Kora mladih grana je maslinasto zelena. Dobro podnosi našu klimu, nije zahtevna biljka. Poželjno ju je posaditi pored vodenih površina. U prodaji biljka u busenu visine 1,5-2 m.', 1),
(29, 'Platan', 1, '1550.00', 144, 0, 'Izuzetno robusno drvo visine do 30 m i širine krošnje do 20 m. Brzorastuća vrsta. Gusta krošnja stvara "debeli" hlad. Listovi su tamno zeleni, režnjeviti, dugački do 25 cm. U jesen su zlatno žuti. Plodne glavice prečnika oko 3 cm ostaju na granama do proleća. Izuzetno je atraktivna i kora debla i starijih grana koja se ljuspa, a ljuspe su u različitim nijansama smeđe boje. Izdržava zimske temperature do -35º. Raste na gotovo svakom zemljištu, na osunčanim položajima. Korenje je veoma snažno i izbija na površinu, pa ga ne treba saditi blizu zastrtih platoa, staza, ulica i sl. jer veoma lako odiže i lomi i beton. Zbog ove osobine, suprotno ustaljenoj praksi, ne treba ga saditi u ulične drvorede, a naravno ni blizu objekata, kako ne bi oštetio temelje. Inače odlično podnosi dim, prašinu i aerozagađenje, pa je jedna od najčešće sađenih vrsta u urbanim zonama.', 1),
(30, 'Magnolia', 1, '800.00', 50, 0, 'Zimzeleno drvo od 3 do 10 m visine raskošne i guste krošnje. List krupan (13-25 cm), sjajno zelenog lica i često cimet smeđe naličja. Cvetovi su bogati kremasto-beli prečnika i do 20cm, mirisni, obično sa 6 latica, počinju da se pojavljuju u kasno proleće. Plodovi su krupne šišarice rumeno crvene boje 7,5-15 cm dugi, sazrevaju u jesen. Voli sunce i delimičnu senku. Najbolje uspeva u bogatom, poroznom, pomalo kiselom zemljištu.    ', 1),
(31, 'Berberis Tiny Gold', 2, '450.00', 45, 0, 'Berberis koji dostiže visinu od 40 cm. Veoma je dekorativan zbog svoje zlatne boje i sitnog lista. Najbolji efekat se postiže sađenjem u grupi na međurastojanju od 50 cm. Lepo se kombinuje sa drugim niskim grmovima, a naročito sa malim crvenim berberisom Admiration. Sadnjom ove dve biljke u kombinaciji dobija se puni efekat.', 1),
(32, 'Forzicija', 2, '320.00', 32, 1, 'Listopadni žbun visine i do 3,5 m. Rano u proleće, ovaj grm prekrije sitni cvet u žutoj boji. Prvo cveta u martu i aprilu, pa onda olista. Voli sunčane pozicije. U manjim vrtovima sadi se pojedinačno, a u  većim sadi se u grupama. Može da se formira i kao živa ograda. U prodaji je biljka visine 60-80 tak cm.', 1),
(33, 'Hibiskus plavi', 2, '450.00', 9, 0, 'Baštenski hibiskus je listopadni grm koji može dostići visinu 2-3m. Listovi su sjajni, tamno-zelene boje. Cvetovi su krupni i javljaju se tokom letnjih meseci. Hibiskus je izdržljiva biljka koja ne traži nikakve posebne uslove, dobro podnosi i niske temperature. Najbolje bi bilo da mu je koren u senci, a krošnja na suncu. Od hibiskusa možete formirati malo drvce, ali i lepu živu ogradu. U prodaji je biljka visine 60-70 cm.', 1),
(34, 'Hibiskus beli', 2, '180.00', 97, 1, 'Baštenski hibiskus je listopadni grm koji može dostići visinu 2-3m. Listovi su sjajni, tamno zelene boje. Cvetovi su krupni i javljaju se tokom letnjih meseci. Ovo je grm koji bogato cveta. Baštenski hibiskus je izdržljiva biljka koja ne traži nikakve posebne uslove. Otporna je i na niske temperature. Najbolje bi bilo da je koren biljke u senci, a krošnja na suncu. Od ove biljke možete formirati i malo drvce, ali i lepu cvetnu živu ogradu. U prodaji su mlade sadnice visine 20-tak cm.', 1),
(35, 'Žalfija', 2, '180.00', 50, 0, 'Žalfija, kao samonikla zeljasta biljka, raste u kamenjarima Mediterana, a kod nas je najviše ima u istočnoj Srbiji. To je grmolika biljka visine do 60 cm. List joj je prekriven gustim dlačicama sa obe strane. Ako nemate vrt, posadite je u saksije ili žardinjere sa ostalim začinskim ili lekovitim biljkama. Veoma lako se održava i neguje, voli sunčano mesto i dobro propusno tlo. Rano u proleće, kada prestanu jutarnji mrazevi, orežite biljku, i ona će se na taj način podmladiti i biće mnogo lepša nego da je niste orezali. U prodaji je mlada biljka visine 5 cm. Sve o žalfiji pročitajte u našem blogu  ŽALFIJA – lekovita i ukrasna biljka.', 1),
(36, 'Imperata cilindrica „Red Baron“', 5, '180.00', 48, 1, 'Ova crvena ukrasna trava ulepsava svaki vrt od juna meseca, pa do kraja jeseni. Izrazito crvena boja lista privlači poglede tokom cele godine. Voli osunčana mesta. Njena visina je 20-30cm. Lepo se kombinuje sa festucom, crnom travom i carex travom.', 1),
(37, 'Penisetum alapecuroides', 5, '170.00', 15, 0, 'Trava visine 60-80cm. Cvetanje je od jula do septembra. Njene žute vlasi ostaju ukras tokom cele zime. Rano u proleće potrebno ju je orezati i ona postaje jos bujnija i lepša nego prethodne godine. Najlepše izgleda pored vodenih površina, i u kombinaciji sa drugim ukrasnim travama.', 1),
(38, 'Stipa tenuissima - Meksicka trava', 5, '170.00', 51, 0, 'Trajnica visine 60-tak cm. Spada u trave. Biljka cveta od juna do avgusta meseca. Specifična je po svojim tankim vlatima. Izuzetno lepo izgleda posađena pored vodenih površina, kao što su veštačka jezera ili male barice.', 1),
(39, 'Festuca glauca', 5, '150.00', 95, 0, 'Ukrasna trava predivne plave boje. Visina biljke je i do 20 cm u vreme cvetanja. Cveta od kraja maja do jula meseca. Lepo se kombinuje sa perenama, niskim četinarima i mini ružama. Poznata je i pod nazivom plava vlasulja. Razmnožava se deljenjem.', 1),
(40, 'Ruže čajevke', 3, '140.00', 58, 0, 'Najomiljenije i najmnogobrojnije ruže sa krupnim i lepo oblikovanim cvetovima, pogodnim za rezanje. Snažnog su porasta i visokih izdanaka. Biljke su visine do 1 m, a najčešće su između 60 i 80 cm, što zavisi od sorte, mesta sađenja i klime. Sade se u grupama, po vrstama, pojedinačno ili vezano sa drugim biljkama. Rastojanje pri sadnji je 50 cm, ili 5 komada po kvadratnom metru. ', 1),
(41, 'Achillea „Paprika“ – crvena hajdučka trava', 3, '110.00', 451, 0, 'Crvena hajdučka trava je biljka visine 60-80 cm. Kompaktnog je rasta i ima dug period cvetanja, tokom celog leta njeni cvetovi ulepšavaju vrt.  U početku cvetovi budu intenzivno crvene boje, a kasnije polako blede. Voli sunčane pozicije. Sadite je kao pozadinu niskim perenama.', 1),
(42, 'Lokvanj ružičasti', 3, '1400.00', 8, 1, 'Lokvanj je jedna od najlepših barskih biljaka. Cveta u letnjim mesecima od juna do septembra. Voli sunce i polusenku. Sadi se na dubini od minimum 45 cm. To je plutajuća biljka. Svake druge godine potrebno ju je podmladiti deljenjem. Ova vrsta je tamno ružičaste boje i krupnih cvetova. U ponudi je veliki lokvanj.', 1),
(43, 'Anemone', 3, '150.00', 15, 0, 'Lepota ove biljke je u njenoj jednostavnosti. Ona ima lep roze cvet koji ukrašava baštu tokom celog leta. Biljka je visine 40-tak  cm. Kada cvet prođe i list se osuši, orežite je i ostaviti tako da prezimi. Ona na proleće kreće ponovo iz korena. U ponudi biljka u saksiji prečnika 12 cm.', 1),
(44, 'Allium – ukrasni luk', 3, '130.00', 15, 1, 'Alium ili ukrasni luk je dekorativna biljka koja ukrašava mnoge vrtove. Cveta početkom proleća i u vreme cvetanja visina biljke dostiže 40-tak cm. Možete je saditi pojedinačno ili u grupama u kombinaciji sa drugim perenama.', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `fk_korisnik_id` FOREIGN KEY (`korisnik`) REFERENCES `korisnici` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sadnica_id` FOREIGN KEY (`sadnica`) REFERENCES `sadnice` (`sadnica_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `narudzbenice`
--
ALTER TABLE `narudzbenice`
  ADD CONSTRAINT `fk_korisnik` FOREIGN KEY (`korisnik`) REFERENCES `korisnici` (`korisnik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sadnica` FOREIGN KEY (`sadnica`) REFERENCES `sadnice` (`sadnica_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sadnice`
--
ALTER TABLE `sadnice`
  ADD CONSTRAINT `fk_kategorija` FOREIGN KEY (`kategorija`) REFERENCES `kategorije` (`kategorija_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
