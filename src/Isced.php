<?php

/*
 * A lightweight class for working with ISCED fields.
 * 
 * Supports two versions of ISCED coding schemes.
 * Does not require any dependencies.
 *
 * @package DreamLibrary
 * @author Safak Samiloglu <safak.samiloglu@dreamapply.com>
 * 
 */

namespace Dream;

use InvalidArgumentException;

class Isced
{

    const VERSION_2011 = '1';
    const VERSION_2013 = 'ISCED-F 2013';


    private static $codes_v2011 = array(
        '0' => 'General Programmes',
        '01' => 'Basic/broad, general programmes',
        '010' => 'Basic/broad, general programmes',
        '01010' => 'Basic programmes',
        '01011' => 'Broad, general programmes',
        '01012' => 'Arts and Crafts',
        '01013' => 'Music',
        '01014' => 'History',
        '01015' => 'Religion/Ethics',
        '01016' => 'Civics',
        '01017' => 'Mother Tongue',
        '01018' => 'Foreign Language',
        '01019' => 'Mathematics',
        '01020' => 'Physics',
        '01021' => 'Chemistry',
        '01022' => 'Biology',
        '01023' => 'Geography',
        '01024' => 'Environmental Education',
        '01025' => 'Health Education',
        '01026' => 'Sports',
        '01027' => 'New Technologies',
        '01028' => 'Economy and Business',
        '01029' => 'Vocational Subjects',
        '01030' => 'Other basic programmes',
        '01031' => 'General programmes with no special subject emphasis',
        '08' => 'Literacy and numeracy',
        '080' => 'Literacy and numeracy',
        '0801' => 'Basic remedial programmes for adults',
        '0802' => 'Literacy',
        '0803' => 'Numeracy',
        '09' => 'Personal development 16.0',
        '090' => 'Personal development',
        '09010' => 'Argumentation and presentation',
        '09011' => 'Assertiveness training',
        '09012' => 'Communication skills',
        '09013' => 'Cooperation',
        '09014' => 'Development of behavioural capacities',
        '09015' => 'Development of mental skills',
        '09016' => 'Jobseeking programmes',
        '09017' => 'Public speaking',
        '09018' => 'Self esteem skills',
        '09019' => 'Social competence',
        '09020' => 'Time management',
        '09021' => 'Physical Education, Sport Science 16.1',
        '09022' => 'Leisure Studies 16.2',
        '09023' => 'Home Economics, Nutrition 16.3',
        '09024' => 'Nautical Science, Navigation 16.4',
        '09025' => 'Others in Other Areas of Study 16.9',
        '1' => 'Education',
        '14' => 'Teacher training and education science',
        '140' => 'Teacher training and education science (broad programmes)',
        '1401' => 'Teacher training, general',
        '1402' => 'Practical pedagogical courses, general',
        '141' => 'Teaching and training 05.1',
        '142' => 'Education science',
        '1421' => 'Didactics',
        '1422' => 'Education science 05.7',
        '1423' => 'Educational assessment, testing and measurement',
        '1424' => 'Educational evaluation and research',
        '1425' => 'Pedagogical sciences 05.8',
        '143' => 'Training for pre-school teachers',
        '1431' => 'Early childhood teaching',
        '1432' => 'Preprimary teacher training',
        '144' => 'Training for teachers at basic levels',
        '1441' => 'Class teacher training',
        '1442' => 'Home language teacher training',
        '1443' => 'Primary teaching 05.2',
        '1444' => 'Teacher training for children with special need 05.6',
        '145' => 'Training for teachers with subject specialisation',
        '1451' => 'Secondary teaching 05.3',
        '1452' => 'Teacher Training theoretical subjects, e.g. English, Mathematics, History',
        '1453' => 'Teacher Training: Foreign Language Teaching',
        '146' => 'Training for teachers of vocational subjects 05.4',
        '1461' => 'Teacher Training arts and crafts',
        '1462' => 'Teacher Training commercial subjects',
        '1463' => 'Teacher Training music',
        '1464' => 'Teacher Training- nursing',
        '1465' => 'Teacher Training -physical training',
        '1466' => 'Teacher Training- technical subjects',
        '1467' => 'Driving instructor training',
        '1468' => 'Training of instructors at companies',
        '1469' => 'Training of trainers',
        '147' => 'Teachers Adult Education 05.5',
        '2' => 'Humanities and Arts',
        '21' => 'Arts',
        '210' => 'Arts (broad programmes)',
        '211' => 'Fine arts 03.1',
        '212' => 'Music and performing arts',
        '2121' => 'Music and Musicology 03.2',
        '2122' => 'Performing Arts 03.3',
        '213' => 'Audio-visual techniques and media production 03.4',
        '214' => 'Design (Graphic Design, Industrial Design, Fashion, Textile) 03.5',
        '215' => 'Craft skills',
        '22' => 'Humanities',
        '220' => 'Humanities (broad programmes)',
        '221' => 'Religion',
        '222' => 'Languages and Philological Sciences 09.0',
        '2221' => 'Modern EC Languages 09.1',
        '2222' => 'General and comparative literature 09.2',
        '2223' => 'Linguistics 09.3',
        '2224' => 'Translation, Interpretation 09.4',
        '2225' => 'Classical Philology 09.5',
        '2226' => 'Non-EC Languages 09.6',
        '2227' => 'Less Widely Taught Languages 09.8',
        '2228' => 'Regional and Minority Languages 09.8a',
        '2229' => 'Others',
        '223' => 'Mother tongue',
        '224' => 'History, philosophy and related subjects 08.3',
        '225' => 'History and archeology 08.4',
        '226' => 'Philosophy and ethics 08.1',
        '227' => 'History of Art 03.6',
        '3' => 'Social sciences, Business and Law',
        '31' => 'Social and behavioural science',
        '310' => 'Social and behavioural science (broad programmes)',
        '311' => 'Psychology 14.4',
        '312' => 'Sociology and cultural studies 14.2',
        '313' => 'Political science and civics 14.1',
        '314' => 'Economics 14.3',
        '315' => 'Social Work 14.5',
        '316' => 'International Relations, European Studies, Area Studies 14.6',
        '317' => 'Anthropology 14.7',
        '318' => 'Development Studies 14.8',
        '32' => 'Journalism and information 15.0',
        '321' => 'Journalism and reporting 15.1',
        '3211' => 'Radio/TV Broadcasting 15.2',
        '322' => 'Library, information, archive 15.4',
        '3221' => 'Documentation, Archiving 15.5',
        '3222' => 'Museum Studies, Conservation 15.6',
        '34' => 'Business and administration',
        '340' => 'Business and administration (broad programmes)',
        '3401' => 'Business Studies with languages 04.1',
        '3402' => 'Business Studies with technology 04.2',
        '341' => 'Wholesale and retail sales',
        '342' => 'Marketing and Sales Management 04.7',
        '3421' => 'Public Relations, Publicity, Advertising 15.3',
        '343' => 'Finance, banking, insurance',
        '344' => 'Accounting and taxation 04.3',
        '345' => 'Management and administration',
        '3451' => 'Industrial Relations and Personnel Management 04.5',
        '3452' => 'Tourism, Catering, Hotel Management 04.4',
        '346' => 'Secretarial and office work 04.6',
        '347' => 'Working life',
        '38' => 'Law',
        '380' => 'Law (broad programmes)',
        '3801' => 'Comparative Law, Law with Languages 10.1',
        '3802' => 'International Law 10.2',
        '3803' => 'Civil Law 10.3',
        '3804' => 'Criminal Law, Criminology 10.4',
        '3805' => 'Constitutional /Public Law 10.5',
        '3806' => 'Public Administration 10.6',
        '3807' => 'European Community/EU Law 10.7',
        '3808' => 'Others',
        '4' => 'Science, Mathematics and Computing',
        '42' => 'Life science 13.0',
        '421' => 'Biology and biochemistry 13.1',
        '4211' => 'Microbiology, Biotechnology 13.4',
        '422' => 'Environmental science',
        '44' => 'Physical science',
        '440' => 'Physical science (broad programmes)',
        '441' => 'Physics 13.2, 13.5, 13.7',
        '442' => 'Chemistry 13.3',
        '4421' => 'Biochemistry 13.6',
        '443' => 'Earth science',
        '4431' => 'Geography, Geology 07.0',
        '4432' => 'Geography 07.1',
        '4433' => 'Environmental Sciences, Ecology 07.2',
        '4434' => 'Geology 07.3',
        '4435' => 'Soil and Water Sciences 07.4',
        '4436' => 'Geodesy, Cartography, Remote Sensing 07.6',
        '4437' => 'Meteorology 07.7',
        '4438' => 'Oceanography 13.8',
        '4439' => 'Others',
        '46' => 'Mathematics and statistics 11.0',
        '461' => 'Mathematics 11.1',
        '462' => 'Statistics 11.2',
        '4621' => 'Actuarial Science 11.5',
        '48' => 'Computing 11.3',
        '481' => 'Computer science',
        '4811' => 'Artificial Intelligence 11.4',
        '482' => 'Computer use',
        '5' => 'Engineering, Manufacturing and Construction',
        '52' => 'Engineering and engineering trades 06.0',
        '520' => 'Engineering and engineering trades (broad programmes)',
        '521' => 'Mechanics and metal work 06.1',
        '522' => 'Electricity and energy 06.2',
        '523' => 'Electronics and automation Era-06.5',
        '524' => 'Chemical and process 06.3',
        '525' => 'Motor vehicles, ships and aircraft',
        '5251' => 'Aeronautical Engineering 06.8',
        '54' => 'Manufacturing and processing 06.6',
        '540' => 'Manufacturing and processing (broad programmes)',
        '541' => 'Food processing',
        '542' => 'Textiles, clothes, footwear, leather',
        '543' => 'Materials (wood, paper, plastic, glass)',
        '544' => 'Mining and extraction',
        '58' => 'Architecture and building',
        '581' => 'Architecture and town planning 02.0',
        '5811' => 'Architecture 02.1',
        '5812' => 'Interior Design 02.2',
        '5813' => 'Urban Planning 02.3',
        '5814' => 'Regional Planning 02.4',
        '5815' => 'Landscape Architecture 02.5',
        '5816' => 'Transport and Traffic Studies 02.6',
        '582' => 'Building and civil engineering 06.4',
        '5821' => 'Materials Science 06.7',
        '6' => 'Agriculture and Veterinary',
        '62' => 'Agriculture, forestry and fishery 01.0',
        '620' => 'Agriculture, forestry and fishery (broad programmes)',
        '6201' => 'Agricultural Economics 01.2',
        '6202' => 'Food Science and Technology 01.3',
        '6203' => 'Tropical/Subtropical Agriculture 01.8',
        '621' => 'Crop and livestock production',
        '622' => 'Horticulture 01.4',
        '623' => 'Forestry 01.6',
        '624' => 'Fisheries 01.5',
        '64' => 'Veterinary',
        '641' => 'Animal Husbandry 01.7',
        '7' => 'Health and Welfare',
        '72' => 'Health',
        '720' => 'Health (broad programmes)',
        '721' => 'Medicine 12.1',
        '7211' => 'Psychiatry and Clinical Psychology 12.2',
        '7212' => 'Public Health 12.7',
        '7213' => 'Medical Technology 12.8',
        '722' => 'Medical services',
        '723' => 'Nursing, Midwifery, Physiotherapy 12.6',
        '724' => 'Dental studies 12.3',
        '725' => 'Medical diagnostic and treatment technology',
        '726' => 'Therapy and rehabilitation',
        '727' => 'Pharmacy 12.5',
        '76' => 'Social services',
        '761' => 'Child care and youth services',
        '762' => 'Social work and counselling',
        '8' => 'Services',
        '81' => 'Personal services',
        '810' => 'Personal services (broad programmes)',
        '811' => 'Hotel, restaurant and catering',
        '812' => 'Travel, tourism and leisure',
        '813' => 'Sports',
        '814' => 'Domestic services',
        '815' => 'Hair and beauty services',
        '84' => 'Transport services',
        '85' => 'Environmental protection',
        '850' => 'Environmental protection (broad programmes)',
        '851' => 'Environmental protection technology',
        '852' => 'Natural environments and wildlife',
        '853' => 'Community sanitation services',
        '86' => 'Security services',
        '860' => 'Security services (broad programmes)',
        '861' => 'Protection of persons and property',
        '862' => 'Occupational health and safety',
        '863' => 'Military and defence',
        '9' => 'Fields unknown',
        '99' => 'Fields unknown',
        '999' => 'Fields unknown'
    );

    private static $codes_v2013 = array(
        '00' => 'Generic programmes and qualifications',
        '001' => 'Basic programmes and qualifications',
        '0011' => 'Basic programmes and qualifications',
        '002' => 'Literacy and numeracy',
        '0021' => 'Literacy and numeracy',
        '003' => 'Personal skills and development',
        '0031' => 'Personal skills and development',
        '01' => 'Education',
        '011' => 'Education 011',
        '0111' => 'Education science',
        '0112' => 'Training for pre-school teachers',
        '0113' => 'Teacher training without subject specialization',
        '0114' => 'Teacher training with subject specialization',
        '02' => 'Arts and humanities',
        '021' => 'Arts',
        '0211' => 'Audio-visual techniques and media production',
        '0212' => 'Fashion, interior and industrial design',
        '0213' => 'Fine arts',
        '0214' => 'Handicrafts',
        '0215' => 'Music and performing arts',
        '022' => 'Humanities (except languages)',
        '0221' => 'Religion and theology',
        '0222' => 'History and archaeology',
        '0223' => 'Philosophy and ethics',
        '023' => 'Languages',
        '0231' => 'Language acquisition',
        '0232' => 'Literature and linguistics',
        '03' => 'Social sciences, journalism and information',
        '031' => 'Social and behavioural sciences',
        '0311' => 'Economics',
        '0312' => 'Political sciences and civics',
        '0313' => 'Psychology 0313',
        '0314' => 'Sociology and cultural studies',
        '032' => 'Journalism and information',
        '0321' => 'Journalism and reporting',
        '0322' => 'Library, information and archival studies',
        '04' => 'Business, administration and law',
        '041' => 'Business and administration',
        '0411' => 'Accounting and taxation',
        '0412' => 'Finance, banking and insurance',
        '0413' => 'Management and administration',
        '0414' => 'Marketing and advertising',
        '0415' => 'Secretarial and office work',
        '0416' => 'Wholesale and retail sales',
        '0417' => 'Work skills',
        '042' => 'Law',
        '0421' => 'Law',
        '05' => 'Natural sciences, mathematics and statistics',
        '051' => 'Biological and related sciences',
        '0511' => 'Biology',
        '0512' => 'Biochemistry',
        '052' => 'Environment',
        '0521' => 'Environmental sciences',
        '0522' => 'Natural environments and wildlife',
        '053' => 'Physical sciences',
        '0531' => 'Chemistry',
        '0532' => 'Earth sciences',
        '0533' => 'Physics',
        '054' => 'Mathematics and statistics',
        '0541' => 'Mathematics',
        '0542' => 'Statistics',
        '06' => 'Information and Communication Technologies (ICTs)',
        '061' => 'Information and Communication Technologies (ICTs)',
        '0611' => 'Computer use',
        '0612' => 'Database and network design and administration',
        '0613' => 'Software and applications development and analysis',
        '07' => 'Engineering, manufacturing and construction',
        '071' => 'Engineering and engineering trades',
        '0711' => 'Chemical engineering and processes',
        '0712' => 'Environmental protection technology',
        '0713' => 'Electricity and energy',
        '0714' => 'Electronics and automation',
        '0715' => 'Mechanics and metal trades',
        '0716' => 'Motor vehicles, ships and aircraft',
        '072' => 'Manufacturing and processing',
        '0721' => 'Food processing',
        '0722' => 'Materials (glass, paper, plastic and wood)',
        '0723' => 'Textiles (clothes, footwear and leather)',
        '0724' => 'Mining and extraction',
        '073' => 'Architecture and construction',
        '0731' => 'Architecture and town planning',
        '0732' => 'Building and civil engineering',
        '08' => 'Agriculture, forestry, fisheries and veterinary',
        '081' => 'Agriculture',
        '0811' => 'Crop and livestock production',
        '0812' => 'Horticulture',
        '082' => 'Forestry',
        '0821' => 'Forestry',
        '083' => 'Fisheries',
        '0831' => 'Fisheries',
        '084' => 'Veterinary',
        '0841' => 'Veterinary',
        '09' => 'Health and welfare',
        '091' => 'Health',
        '0911' => 'Dental studies',
        '0912' => 'Medicine',
        '0913' => 'Nursing and midwifery',
        '0914' => 'Medical diagnostic and treatment technology',
        '0915' => 'Therapy and rehabilitation',
        '0916' => 'Pharmacy',
        '0917' => 'Traditional and complementary medicine and therapy',
        '092' => 'Welfare',
        '0921' => 'Care of the elderly and of disabled adults',
        '0922' => 'Child care and youth services',
        '0923' => 'Social work and counselling',
        '10' => 'Services',
        '101' => 'Personal services',
        '1011' => 'Domestic services',
        '1012' => 'Hair and beauty services',
        '1013' => 'Hotel, restaurants and catering',
        '1014' => 'Sports',
        '1015' => 'Travel, tourism and leisure',
        '102' => 'Hygiene and occupational health services',
        '1021' => 'Community sanitation',
        '1022' => 'Occupational health and safety',
        '103' => 'Security services',
        '1031' => 'Military and defence',
        '1032' => 'Protection of persons and property',
        '104' => 'Transport services',
        '1041' => 'Transport services'
    );


    public static function isCode($code, $version) {

        // self::_getList() will make sure a proper version is given by caller
        return array_key_exists($code, self::_getList($version));

    }


    public static function fetchNameByCode($code, $version) {

        $code = (string) $code;

        // self::_getList() will make sure a proper version is given by caller
        $list = self::_getList($version);

        if (!self::isCode($code, $version)) {
            throw new InvalidArgumentException('Illegal ISCED code: ' . $code);
        }

        return $list[$code];

    }


    public static function fetchCrumbsByCode($code, $version) {

        $code = (string) $code;

        // self::_getList() will make sure a proper version is given by caller
        $list = self::_getList($version);

        $crumbs = [];

        do {

            if (array_key_exists($code, $list)) {

                $crumbs[$code] = $list[$code];

            }

            $code = substr($code, 0, -1);

        } while (strlen($code));

        return $crumbs;

    }


    public static function fetchCodeListing($version) {

        // self::_getList() will make sure a proper version is given by caller
        return self::_getList($version);

    }


    private function _getList($version) {

        $version = self::_assertVersion($version);

        switch ($version) {
            case self::VERSION_2011:
                return self::$codes_v2011;
            case self::VERSION_2013:
                return self::$codes_v2013;
        }

    }


    private function _assertVersion($version) {

        if (!in_array($version, [self::VERSION_2011, self::VERSION_2013])) {
            throw new InvalidArgumentException('Unknown version: ' . $version);
        }

        return $version;

    }

}