<?php

namespace LeandroSe\ValidadorBrasil\Validador;

class IETest extends \PHPUnit_Framework_TestCase
{

    public function testIsento()
    {
        $this->assertTrue(IE::validar('ISENTO', 'SP'));
    }

    /**
     * @group IE
     * @group IEAC
     */
    public function testIEAC()
    {
        $arr = [
            '01.299.057/387-00', '01.299.057/387-00', '01.004.823/001-12',
            '0100482300112', '0130060268601', '0145712630380',
            '0102433270708', '0134563371235', '0103099446082',
            '0180481726610', '0197561767520', '0164863457650',
            '0141254633246', '0179133595693', '0195995285414'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'AC'), $i);
        }
    }

    /**
     * @group IE
     * @group IEAC
     */
    public function testIEACFalha()
    {
        $this->assertFalse(IE::validar('0241254633246', 'AC'));

        $arr = [
            '01.299.057/387-01', '01.299.057/387-20', '01.004.823/001-13',
            '0100482300142', '0130060268611', '0145712630342',
            '014571263034'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'AC'), $i);
        }
    }

    /**
     * @group IE
     * @group IEAL
     */
    public function testIEAL()
    {
        $arr = [
            '240000048', '248679937', '248878255', '248831658', '248004069',
            '248479130'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'AL'), $i);
        }
    }

    /**
     * @group IE
     * @group IEAL
     */
    public function testIEALFalha()
    {
        foreach ([0, 1, 2, 3, 4, 5, 6, 7, 9] as $i) {
            $this->assertFalse(IE::validar('24000004' . $i, 'AL'), '24000004' . $i);
        }
        $this->assertFalse(IE::validar('24867993', 'AL'), '24867993' . $i);
        $this->assertFalse(IE::validar('238004069', 'AL'), '238004069' . $i);
    }

    /**
     * @group IE
     * @group IEAP
     */
    public function testIEAP()
    {
        $arr = [
            '030123459', '033221863', '039983625', '030000012',
            '030170011', '030190231', '033157740', '037665332',
            '038005336', '033418519', '030641004', '034642536',
            '030187861'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'AP'), $i);
        }
    }

    /**
     * @group IE
     * @group IEAP
     */
    public function testIEAPFalha()
    {
        foreach (['03000001', '03017001', '03019023'] as $ie) {
            $count = 0;
            foreach ([0, 1, 2, 3, 4, 5, 6, 7, 8, 9] as $i) {
                if (IE::validar($ie . $i, 'AP')) {
                    ++$count;
                }
            }
            $this->assertEquals(1, $count, $ie);
        }
        $this->assertFalse(IE::validar('03000001', 'AP'), '03000001');
        $this->assertFalse(IE::validar('130123459', 'AP'), '130123459');
    }

    /**
     * @group IE
     * @group IEAM
     */
    public function testIEAM()
    {
        $arr = [
            '877828946', '419781145', '617710503', '589876660', '003169995',
            '513402349', '174900910', '000000019',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'AM'), $i);
        }
    }

    /**
     * @group IE
     * @group IEAM
     */
    public function testIEAMFalha()
    {
        $arr = ['87782894', '41978114', '61771050', '58987666', '00316999', '51340234'];
        foreach ($arr as $ie) {
            $count = 0;
            foreach ([0, 1, 2, 3, 4, 5, 6, 7, 8, 9] as $i) {
                if (IE::validar($ie . $i, 'AM')) {
                    ++$count;
                }
            }
            $this->assertEquals(1, $count, $ie);
        }

        $this->assertFalse(IE::validar('51340234', 'AM'), '51340234');
    }

    /**
     * @group IE
     * @group IEBA
     */
    public function testIEBA()
    {
        $arr = [
            '12345663', '61234557',
            '100000306', '991854017',
            '05191978', '18219054', '27415957', '33694573', '47287949', '57112400', '81347674',
            '66448556', '70061739', '98872523',
            '753741175', '086069155', '430609530', '916090735', '060607851',
            '74742710', '595686400',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'BA'), $i);
        }
    }

    /**
     * @group IE
     * @group IEBA
     */
    public function testIEBAFalha()
    {
        $this->assertFalse(IE::validar('1234563', 'BA'), '1234563');
        $this->assertFalse(IE::validar('74742712', 'BA'), '74742712');
        $this->assertFalse(IE::validar('74742720', 'BA'), '74742720');
        $this->assertFalse(IE::validar('753741176', 'BA'), '753741176');
        $this->assertFalse(IE::validar('753741165', 'BA'), '753741165');
    }

    /**
     * @group IE
     * @group IECE
     */
    public function testIECE()
    {
        $arr = [
            '678923400', '199608024', '054657717', '707335663', '688335160'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'CE'), $i);
        }
    }

    /**
     * @group IE
     * @group IECE
     */
    public function testIECEFalha()
    {
        $arr = [
            '678923401', '0199608024'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'CE'), $i);
        }
    }

    /**
     * @group IE
     * @group IEDF
     */
    public function testIEDF()
    {
        $arr = [
            '0726137800167', '0736681100104', '0779072200196', '0712091600110', '0764631100130'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'DF'), $i);
        }
    }

    /**
     * @group IE
     * @group IEDF
     */
    public function testIEDFFalha()
    {
        $arr = [
            '0726137800166', '0726137800177', '0826137800167', '072613780016'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'DF'), $i);
        }
    }

    /**
     * @group IE
     * @group IEES
     */
    public function testIEES()
    {
        $arr = [
            '286963680', '591962624', '418738599', '913400750', '426033531', '999999990'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'ES'), $i);
        }
    }

    /**
     * @group IE
     * @group IEES
     */
    public function testIEESFalha()
    {
        $arr = [
            '286963681', '28696368', '296963680', '086963680'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'ES'), $i);
        }
    }

    /**
     * @group IE
     * @group IEGO
     */
    public function testIEGO()
    {
        $arr = [
            '110944020', '110944021', // FIXO
            '101199971', '101186101',
            '101178141', '101178281', '101178311', '101178451', '101178591', // PERIODO
            '101200200', '101200340', '101200480', '101200510', '101200650', // FORA PERIODO
            '111444780', '158190661', '156656884', '103439293', '108084299', '156564947',
            '102058920', '151449490', '119126010', '106121901', '112539491', '118443291'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'GO'), $i);
        }
    }

    /**
     * @group IE
     * @group IEGO
     */
    public function testIEGOFalha()
    {
        $arr = [
            '101178351', '101178310', '121178311', '12117831'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'GO'), $i);
        }
    }

    /**
     * @group IE
     * @group IEMA
     */
    public function testIEMA()
    {
        $arr = [
            '120000385', '126561680', '122807642', '122921291', '124005608',
            '122843819', '123555817',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'MA'), $i);
        }
    }

    /**
     * @group IE
     * @group IEMA
     */
    public function testIEMAFalha()
    {
        $arr = [
            '120000386', '130000385', '12000038'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'MA'), $i);
        }
    }

    /**
     * @group IE
     * @group IEMT
     */
    public function testIEMT()
    {
        $arr = [
            '86073496283', '04250808300', '94562544958', '44314410963',
            '68489688615', '38975952142', '37072032617', '66343877891',
            '79575006700', '62678514380', '30764350180', '07484745490'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'MT'), $i);
        }
    }

    /**
     * @group IE
     * @group IEMT
     */
    public function testIEMTFalha()
    {
        $arr = [
            '86073496282', '86073496253', '8607349628'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'MT'), $i);
        }
    }

    /**
     * @group IE
     * @group IEMS
     */
    public function testIEMS()
    {
        $arr = [
            '282349790', '287533581', '288926412', '280345143',
            '285901494', '283442905', '284979856', '287073807',
            '286659018', '284882909', '281370150'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'MS'), $i);
        }
    }

    /**
     * @group IE
     * @group IEMS
     */
    public function testIEMSFalha()
    {
        $arr = [
            '282349791', '28234979', '292349790', '452349790'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'MS'), $i);
        }
    }

    /**
     * @group IE
     * @group IEMG
     */
    public function testIEMG()
    {
        $arr = [
            '0623079040081',
            '9234877651030', '2217079817111', '2261519024992', '8328560285213',
            '0619247778874', '5012743314245', '4771522864926', '1455263782667',
            '6250722416938', '4764296174629',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'MG'), $i);
        }
    }

    /**
     * @group IE
     * @group IEMG
     */
    public function testIEMGFalha()
    {
        $arr = [
            '9234877651031', '9234877651010', '923487765103', '0234877651030'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'MG'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPA
     */
    public function testIEPA()
    {
        $arr = [
            '151602000', '159197031', '159469422', '155318403',
            '158246594', '155981625', '156765136', '151675287',
            '154061778', '159570409',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'PA'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPA
     */
    public function testIEPAFalha()
    {
        $arr = [
            '161602000', '151602001', '155981628', '15598162'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'PA'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPB
     */
    public function testIEPB()
    {
        $arr = [
            '416071210', '561839271', '368009122', '853610223',
            '578110784', '801377285', '844381926', '830188657',
            '990074218', '280173059', '219850941', '951834720'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'PB'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPB
     */
    public function testIEPBFalha()
    {
        $arr = [
            '41607121', '416071211'
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'PB'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPR
     */
    public function testIEPR()
    {
        $arr = [
            '1958845100', '4705894421', '2515972512', '1238436903',
            '7104097574', '5566675945', '8757842506', '6776681057',
            '4558206778', '2703910109',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'PR'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPR
     */
    public function testIEPRFalha()
    {
        $arr = [
            '1958845101', '1958845110', '195884510', '1558845100',
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'PR'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPE
     */
    public function testIEPE()
    {
        $arr = [
            '177321580', '234380101', '027534642', '179751743',
            '037018914', '209771585', '059449616', '748143467',
            '427142148', '893433799',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'PE'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPE
     */
    public function testIEPEFalha()
    {
        $arr = [
            '177321581', '177321510', '17732158', '187321580',
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'PE'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPI
     */
    public function testIEPI()
    {
        $arr = [
            '464617880', '431525161', '397923112', '682352063',
            '528862464', '198454805', '248755846', '116869577',
            '429529678', '428904939', '063999420'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'PI'), $i);
        }
    }

    /**
     * @group IE
     * @group IEPI
     */
    public function testIEPIFalha()
    {
        $arr = [
            '464617881', '454617880', '46461788',
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'PI'), $i);
        }
    }

    /**
     * @group IE
     * @group IERJ
     */
    public function testIERJ()
    {
        $arr = [
            '27603440', '80879091', '39118912', '51323823',
            '56717404', '04664825', '75288476', '82251057',
            '32601448', '43963279',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'RJ'), $i);
        }
    }

    /**
     * @group IE
     * @group IERJ
     */
    public function testIERJFalha()
    {
        $arr = [
            '27603441', '2760344', '25603440',
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'RJ'), $i);
        }
    }

    /**
     * @group IE
     * @group IERN
     */
    public function testIERN()
    {
        $arr = [
            '2074749880', '2026593051', '2059927552', '2006543733',
            '2088745254', '2043510355', '2086335806', '2053495367',
            '2054896748', '2025735359', '2030857840'
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'RN'), $i);
        }
    }

    /**
     * @group IE
     * @group IERN
     */
    public function testIERNFalha()
    {
        $arr = [
            '2074749885', '2174749880', '20544980',
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'RN'), $i);
        }
    }

    /**
     * @group IE
     * @group IERS
     */
    public function testIERS()
    {
        $arr = [
            '4488979970', '0962993301', '2169802112', '6953337463',
            '4503017704', '8704022465', '6085570906', '9782040857',
            '5786875578', '7261888649',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'RS'), $i);
        }
    }

    /**
     * @group IE
     * @group IERS
     */
    public function testIERSFalha()
    {
        $arr = [
            '4488979971', '4588979970', '488979970',
        ];
        foreach ($arr as $i) {
            $this->assertFalse(IE::validar($i, 'RS'), $i);
        }
    }

    /**
     * @group IE
     * @group IERO
     */
    public function testIERO()
    {
        $arr = [
            '21383617386150', '95900911101271', '02126164537032', '21371276845873',
            '70029898595444', '90394760612585', '80501747669666', '58756014403087',
            '02398637750838', '66041472517209',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'RO'), $i);
        }
    }

    /**
     * @group IE
     * @group IERR
     */
    public function testIERR()
    {
        $arr = [
            '245156990', '245569511', '244076672', '245185633',
            '246916514', '249331105', '249138656', '240554747',
            '243416218', '244730564',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'RR'), $i);
        }
    }

    /**
     * @group IE
     * @group IESC
     */
    public function testIESC()
    {
        $arr = [
            '805448240', '769829309', '810304082', '834295903',
            '891453334', '996529365', '741806096', '575582197',
            '623126958', '346134269',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'SC'), $i);
        }
    }

    /**
     * @group IE
     * @group IESP
     */
    public function testIESP()
    {
        $arr = [
            // '110.042.490.114',
            '177725288140', '288234556861', '929959067942', '127183792713',
            '923533086304', '886907540935', '075196941116', '227282834737',
            '096377731858', '424790023879',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'SP'), $i);
        }
    }

    /**
     * @group IE
     * @group IESE
     */
    public function testIESE()
    {
        $arr = [
            '841893250', '811074781', '939219492', '636808203',
            '206956274', '774614765', '085658006', '822123517',
            '851392768', '672464969',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'SE'), $i);
        }
    }

    /**
     * @group IE
     * @group IETO
     */
    public function testIETO()
    {
        $arr = [
            '78013238800', '44014826491', '80020569342', '31012208243',
            '64990386024', '91014458345', '39012739186', '11991730937',
            '25991751708', '44999569799',
        ];
        foreach ($arr as $i) {
            $this->assertTrue(IE::validar($i, 'TO'), $i);
        }
    }
}
