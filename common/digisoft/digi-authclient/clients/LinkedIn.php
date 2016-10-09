<?php

namespace digi\authclient\clients;

use Yii;
use common\helpers\GoogleChartHelper;
use common\helpers\InstagramGoogleChartHelper;
use common\models\custom\Authclient;
use common\models\custom\Model;
use common\models\custom\Insights;
use common\models\custom\RecentFollowers;
use yii\web\NotFoundHttpException;

class LinkedIn extends \yii\authclient\clients\LinkedIn
{
    const ACCOUNT = 0;
    const POST = 1;
    const IMAGE = 0;
    const VIDEO = 1;
    
    const COMPANYSIZE = [
        'A' => 'Self-employed', 
        'B' => '1-10', 
        'C' => '11-50', 
        'D' => '51-200', 
        'E' => '201-500', 
        'F' => '501-1000', 
        'G' => '1001-5000', 
        'H' => '5001-10,000',  
        'I' => '10,001+', 
        ];
    const COUNTRY = [
        'af' => 'Africa', 'dz' => 'Algeria', 'cm' => 'Cameroon', 'eg' => 'Egypt', 'gh' => 'Ghana', 'ke' => 'Kenya', 'ma' => 'Morocco', 'ng' => 'Nigeria', 'za' => 'South Africa',
        'af.za.*.5852' => 'Cape Town Area, South Africa', 'af.za.*.5855' => 'Durban Area, South Africa', 'af.za.*.5862' => 'Johannesburg Area, South Africa', 'af.tz' => 'Tanzania', 'af.tn' => 'Tunisia', 
        'af.ug' => 'Uganda', 'af.zw' => 'Zimbabwe', 'aq' => 'Antarctica', 'as' => 'Asia', 'as.bd' => 'Bangladesh', 'as.cn' => 'China', 'as.cn.*.8911' => 'Beijing City, China', 'as.cn.*.8919' => 'Guangzhou, Guangdong, China',
        'as.cn.*.8909' => 'Shanghai City, China', 'as.cn.*.8910' => 'Shenzhen, Guangdong, China', 'as.hk' => 'Hong Kong', 'as.in' => 'India', 'as.in.an' => 'Andaman & Nicobar Islands', 'as.in.ap' => 'Andhra Pradesh',
        'as.in.ap.6508' => 'Hyderabad Area, India', 'as.in.ar' => 'Arunachal Pradesh', 'as.in.as' => 'Assam', 'as.in.br' => 'Bihar', 'as.in.ch' => 'Chandigarh', 'as.in.cg' => 'Chattisgarh', 'as.in.dn' => 'Dadra& Nagar Haveli',
        'as.in.dd' => 'Daman & Diu', 'as.in.dl' => 'Delhi', 'as.in.ga' => 'Goa', 'as.in.gj' => 'Gujarat', 'as.in.gj.7065' => 'Ahmedabad Area, India', 'as.in.gj.6552' => 'Vadodara Area, India', 'as.in.hr' => 'Haryana',
        'in' => 'India', 'as.in.hr.7151' => 'New Delhi Area, India', 'as.in.hp' => 'Himachal Pradesh', 'as.in.jk' => 'Jammu & Kashmir', 'as.in.jh' => 'Jharkhand', 'as.in.ka' => 'Karnataka',
        'as.in.ka.7127' => 'Bengaluru Area, India', 'as.in.kl' => 'Kerala', 'as.in.kl.6477' => 'Cochin Area, India', 'as.in.ld' => 'Lakshadweep', 'as.in.mp' => 'Madhya Pradesh', 'as.in.mp.7382' => 'Indore Area, India',
        'as.in.mh' => 'Maharashtra', 'as.in.mh.7150' => 'Mumbai Area, India', 'as.in.mh.6751' => 'Nagpur Area, India', 'as.in.mh.7350' => 'Pune Area, India', 'as.in.mn' => 'Manipur', 'as.in.ml' => 'Meghalaya', 'as.in.mz' => 'Mizoram',
        'as.in.nl' => 'Nagaland', 'as.in.or' => 'Orissa', 'as.in.py' => 'Pondicherry', 'as.in.pb' => 'Punjab', 'as.in.pb.6879' => 'Chandigarh Area, India', 'as.in.rj' => 'Rajasthan', 'as.in.rj.7287' => 'Jaipur Area, India', 'as.in.sk' => 'Sikkim',
        'as.in.tn' => 'Tamil Nadu', 'as.in.tn.6891' => 'Chennai Area, India', 'as.in.tn.6472' => 'Coimbatore Area, India', 'as.in.tr' => 'Tripura', 'as.in.up' => 'Uttar Pradesh', 'as.in.up.7093' => 'Lucknow Area, India',
        'as.in.up.7392' => 'Noida Area, India', 'as.in.ul' => 'Uttarakhand', 'as.in.wb' => 'West Bengal', 'as.in.wb.7003' => 'Kolkata Area, India', 'as.id' => 'Indonesia', 'as.id.*.8594' => 'Greater Jakarta Area, Indonesia', 'as.jp' => 'Japan',
        'kr' => 'Korea', 'as.kr.*.7700' => 'Gangnam-gu, Seoul, Korea', 'my' => 'Malaysia', 'as.my.*.7960' => 'Kuala Lumpur, Malaysia', 'as.my.*.7945' => 'Selangor, Malaysia', 'as.np' => 'Nepal', 'as.ph' => 'Philippines', 'as.sg' => 'Singapore',
        'lk' => 'Sri Lanka', 'tw' => 'Taiwan', 'th' => 'Thailand', 'vn' => 'Vietnam', 'eu' => 'Europe', 'eu.at' => 'Austria', 'eu.be' => 'Belgium', 'eu.be.*.4918' => 'Antwerp Area, Belgium', 'eu.be.*.4920' => 'Brussels Area, Belgium', 'eu.bg' => 'Bulgaria',
        'hr' => 'Croatia', 'cz' => 'Czech Republic', 'eu.dk' => 'Denmark', 'eu.dk.*.5038' => 'Copenhagen Area, Denmark', 'eu.dk.*.5041' => 'Odense Area, Denmark', 'eu.dk.*.5044' => 'Ålborg Area, Denmark', 'eu.dk.*.5045' => 'Århus Area, Denmark', 'eu.fi' => 'Finland', 
        'fr' => 'France', 'eu.fr.*.5205' => 'Lille Area, France', 'eu.fr.*.5210' => 'Lyon Area, France', 'eu.fr.*.5211' => 'Marseille Area, France', 'eu.fr.*.5221' => 'Nice Area, France', 'eu.fr.*.5227' => 'Paris Area, France', 'eu.fr.*.5249' => 'Toulouse Area, France',
        'de' => 'Germany', 'eu.de.*.4953' => 'Cologne Area, Germany', 'eu.de.*.4966' => 'Frankfurt Am Main Area, Germany', 'eu.de.*.5000' => 'Munich Area, Germany', 'eu.gr' => 'Greece', 'eu.hu' => 'Hungary', 'eu.ie' => 'Ireland', 'eu.it' => 'Italy', 'eu.it.*.5587' => 'Bologna Area, Italy',
        'eu.it.*.5616' => 'Milan Area, Italy', 'eu.it.*.5636' => 'Rome Area, Italy', 'eu.it.*.5652' => 'Turin Area, Italy', 'eu.it.*.5657' => 'Venice Area, Italy', 'eu.lt' => 'Lithuania', 'eu.nl' => 'Netherlands', 'eu.nl.*.5663' => 'Almere Stad Area, Netherlands',
        'eu.nl.*.5664' => 'Amsterdam Area, Netherlands', 'eu.nl.*.5665' => 'Apeldoorn Area, Netherlands', 'eu.nl.*.5906' => 'Breda Area, Netherlands', 'eu.nl.*.5668' => 'Eindhoven Area, Netherlands', 'eu.nl.*.5669' => 'Enschede Area, Netherlands', 'eu.nl.*.5673' => 'Groningen Area, Netherlands',
        'eu.nl.*.5681' => 'Nijmegen Area, Netherlands', 'eu.nl.*.5908' => 'Rotterdam Area, Netherlands', 'eu.nl.*.5688' => 'The Hague Area, Netherlands', 'eu.nl.*.5907' => 'Tilburg Area, Netherlands', 'eu.nl.*.5690' => 'Utrecht Area, Netherlands', 'eu.no' => 'Norway', 'eu.no.*.5712' => 'Oslo Area, Norway',
        'eu.pl' => 'Poland', 'eu.pt' => 'Portugal', 'eu.pt.*.7405' => 'Lisbon Area, Portugal', 'eu.pt.*.7397' => 'Porto Area, Portugal', 'eu.ro' => 'Romania', 'eu.ru' => 'Russian Federation', 'eu.rs' => 'Serbia', 'eu.sk' => 'Slovak Republic', 'eu.es' => 'Spain', 'eu.es.*.5064' => 'Barcelona Area, Spain',
        'eu.es.*.5113' => 'Madrid Area, Spain', 'eu.se' => 'Sweden', 'eu.ch' => 'Switzerland', 'eu.ch.*.4930' => 'Geneva Area, Switzerland', 'eu.ch.*.4938' => 'Zürich Area, Switzerland', 'eu.tr' => 'Turkey', 'eu.tr.*.7585' => 'Istanbul, Turkey', 'eu.ua' => 'Ukraine', 'eu.gb' => 'United Kingdom',
        'eu.gb.*.4544' => 'Birmingham, United Kingdom', 'eu.gb.*.4550' => 'Brighton, United Kingdom', 'eu.gb.*.4552' => 'Bristol, United Kingdom', 'eu.gb.*.4555' => 'Cambridge, United Kingdom', 'eu.gb.*.4558' => 'Chelmsford, United Kingdom', 'eu.gb.*.4562' => 'Coventry, United Kingdom', 
        'eu.gb.*.4574' => 'Edinburgh, United Kingdom', 'eu.gb.*.4579' => 'Glasgow, United Kingdom', 'eu.gb.*.4580' => 'Gloucester, United Kingdom', 'eu.gb.*.4582' => 'Guildford, United Kingdom', 'eu.gb.*.4583' => 'Harrow, United Kingdom', 'eu.gb.*.4586' => 'Hemel Hempstead, United Kingdom', 
        'eu.gb.*.4597' => 'Kingston upon Thames, United Kingdom', 'eu.gb.*.4606' => 'Leeds, United Kingdom', 'eu.gb.*.4603' => 'Leicester, United Kingdom', 'eu.gb.*.4573' => 'London, United Kingdom', 'eu.gb.*.4608' => 'Manchester, United Kingdom', 'eu.gb.*.4610' => 'Milton Keynes, United Kingdom', 
        'eu.gb.*.4612' => 'Newcastle upon Tyne, United Kingdom', 'eu.gb.*.4614' => 'Northampton, United Kingdom', 'eu.gb.*.4613' => 'Nottingham, United Kingdom', 'eu.gb.*.4618' => 'Oxford, United Kingdom', 'eu.gb.*.4623' => 'Portsmouth, United Kingdom', 'eu.gb.*.4625' => 'Reading, United Kingdom', 
        'eu.gb.*.4626' => 'Redhill, United Kingdom', 'eu.gb.*.4628' => 'Sheffield, United Kingdom', 'eu.gb.*.4632' => 'Slough, United Kingdom', 'eu.gb.*.4635' => 'Southampton, United Kingdom', 'eu.gb.*.4644' => 'Tonbridge, United Kingdom', 'eu.gb.*.4648' => 'Twickenham, United Kingdom', 'la' => 'Latin America', 
        'la.ar' => 'Argentina', 'la.bo' => 'Bolivia', 'la.br' => 'Brazil', 'la.br.ac' => 'Acre', 'la.br.al' => 'Alagoas', 'la.br.ap' => 'Amapá', 'la.br.am' => 'Amazonas', 'la.br.ba' => 'Bahia', 'la.br.ce' => 'Ceará', 'la.br.df' => 'Distrito Federal', 'la.br.es' => 'Espírito Santo', 'la.br.go' => 'Goiás', 
        'la.br.ma' => 'Maranhão', 'la.br.mt' => 'Mato Grosso', 'la.br.ms' => 'Mato Grosso do Sul', 'la.br.mg' => 'Minas Gerais', 'la.br.mg.6156' => 'Belo Horizonte Area, Brazil', 'la.br.pr' => 'Paraná', 'la.br.pr.6399' => 'Curitiba Area, Brazil', 'la.br.pb' => 'Paraíba', 'la.br.pa' => 'Pará', 'la.br.pe' => 'Pernambuco', 
        'la.br.pi' => 'Piauí', 'la.br.rn' => 'Rio Grande do Norte', 'la.br.rs' => 'Rio Grande do Sul', 'la.br.rs.6467' => 'Porto Alegre Area, Brazil', 'la.br.rj' => 'Rio de Janeiro', 'la.br.rj.6034' => 'Rio de Janeiro Area, Brazil', 'la.br.ro' => 'Rondônia', 'la.br.rr' => 'Roraima', 'la.br.sc' => 'Santa Catarina', 
        'la.br.se' => 'Sergipe', 'la.br.sp' => 'São Paulo', 'la.br.sp.6104' => 'Campinas Area, Brazil', 'la.br.sp.6368' => 'São Paulo Area, Brazil', 'la.br.to' => 'Tocantins', 'la.cl' => 'Chile', 'la.co' => 'Colombia','la.cr' => 'Costa Rica', 'la.do' => 'Dominican Republic', 'la.ec' => 'Ecuador','la.gt' => 'Guatemala',
        'la.mx' => 'Mexico','la.mx.*.5921' => 'Mexico City Area, Mexico', 'la.mx.*.5955' => 'Naucalpan de Juárez Area, Mexico', 'la.pa' => 'Panama', 'la.pe' => 'Peru', 'la.pr' => 'Puerto Rico', 'la.tt' => 'Trinidad and Tobago', 'la.uy' => 'Uruguay', 'la.ve' => 'Venezuela', 'me' => 'Middle East', 'me.bh' => 'Bahrain',
        'me.il' => 'Israel', 'me.jo' => 'Jordan', 'me.kw' => 'Kuwait', 'me.pk' => 'Pakistan', 'me.qa' => 'Qatar', 'me.sa' => 'Saudi Arabia', 'me.ae' => 'United Arab Emirates', 'na' => 'North America', 'na.ca' => 'Canada', 'na.ca.ab' => 'Alberta', 'na.ca.ab.4882' => 'Calgary, Canada Area', 'na.ca.ab.4872' => 'Edmonton, Canada Area', 
        'na.ca.bc' => 'British Columbia', 'na.ca.bc.4873' => 'British Columbia, Canada', 'na.ca.bc.4880' => 'Vancouver, Canada Area', 'na.ca.mb' => 'Manitoba', 'na.ca.nb' => 'New Brunswick', 'na.ca.nl' => 'Newfoundland And Labrador', 'na.ca.nt' => 'Northwest Territories', 'na.ca.ns' => 'Nova Scotia', 'na.ca.ns.4874' => 'Halifax, Canada Area', 
        'na.ca.nu' => 'Nunavut', 'na.ca.on' => 'Ontario', 'na.ca.on.4865' => 'Kitchener, Canada Area', 'na.ca.on.4869' => 'London, Canada Area', 'na.ca.on.4864' => 'Ontario, Canada', 'na.ca.on.4876' => 'Toronto, Canada Area', 'na.ca.pe' => 'Prince Edward Island', 'na.ca.qc' => 'Quebec', 'na.ca.qc.4863' => 'Montreal, Canada Area', 
        'na.ca.qc.4884' => 'Ottawa, Canada Area', 'na.ca.qc.4875' => 'Quebec, Canada', 'na.ca.qc.4866' => 'Winnipeg, Canada Area', 'na.ca.sk' => 'Saskatchewan', 'na.ca.yt' => 'Yukon', 'na.us' => 'United States', 'na.us.al' => 'Alabama', 'na.us.al.100' => 'Birmingham, Alabama Area', 'na.us.ak' => 'Alaska',
        'na.us.ak.38' => 'Anchorage, Alaska Area', 'na.us.az' => 'Arizona', 'na.us.az.620' => 'Phoenix, Arizona Area', 'na.us.az.852' => 'Tucson, Arizona Area', 'na.us.ar' => 'Arkansas', 'na.us.ar.440' => 'Little Rock, Arkansas Area', 'na.us.ca' => 'California', 'na.us.ca.284' => 'Fresno, California Area',
        'na.us.ca.49' => 'Greater Los Angeles Area', 'na.us.ca.732' => 'Greater San Diego Area', 'na.us.ca.51' => 'Orange County, California Area', 'na.us.ca.82' => 'Sacramento, California Area', 'na.us.ca.712' => 'Salinas, California Area', 'na.us.ca.84' => 'San Francisco Bay Area', 'na.us.ca.748' => 'Santa Barbara, California Area', 
        'na.us.ca.812' => 'Stockton, California Area', 'na.us.co' => 'Colorado', 'na.us.co.172' => 'Colorado Springs, Colorado Area', 'na.us.co.267' => 'Fort Collins, Colorado Area', 'na.us.co.34' => 'Greater Denver Area', 'na.us.ct' => 'Connecticut', 'na.us.ct.327' => 'Hartford, Connecticut Area', 
        'na.us.ct.552' => 'New London/Norwich, Connecticut Area', 'na.us.de' => 'Delaware', 'na.us.dc' => 'District Of Columbia', 'na.us.dc.97' => 'Washington D.C. Metro Area', 'na.us.fl' => 'Florida', 'na.us.fl.202' => 'Daytona Beach, Florida Area', 'na.us.fl.270' => 'Fort Myers, Florida Area', 
        'na.us.fl.271' => 'Fort Pierce, Florida Area', 'na.us.fl.290' => 'Gainesville, Florida Area', 'na.us.fl.398' => 'Lakeland, Florida Area', 'na.us.fl.490' => 'Melbourne, Florida Area', 'na.us.fl.56' => 'Miami/Fort Lauderdale Area', 'na.us.fl.596' => 'Orlando, Florida Area', 'na.us.fl.751' => 'Sarasota, Florida Area', 
        'na.us.fl.828' => 'Tampa/St. Petersburg, Florida Area', 'na.us.fl.896 '=> 'West Palm Beach, Florida Area', 'na.us.ga' => 'Georgia', 'na.us.ga.52' => 'Greater Atlanta Area', 'na.us.ga.359' => 'Jacksonville, Florida Area', 'na.us.ga.824' => 'Tallahassee, Florida Area', 'na.us.hi' => 'Hawaii', 'na.us.hi.332' => 'Hawaiian Islands', 
        'na.us.id' => 'Idaho', 'na.us.id.108' => 'Boise, Idaho Area', 'na.us.il' => 'Illinois', 'na.us.il.14' => 'Greater Chicago Area', 'na.us.il.612' => 'Peoria, Illinois Area', 'na.us.il.140' => 'Urbana-Champaign, Illinois Area', 'na.us.in' => 'Indiana', 'na.us.in.244' => 'Evansville, Indiana Area', 'na.us.in.348' => 'Indianapolis, Indiana Area', 
        'na.us.ia' => 'Iowa', 'na.us.ks' => 'Kansas', 'na.us.ks.904' => 'Wichita, Kansas Area', 'na.us.ky' => 'Kentucky', 'na.us.ky.428' => 'Lexington, Kentucky Area', 'na.us.ky.452' => 'Louisville, Kentucky Area', 'na.us.la' => 'Louisiana', 'na.us.me' => 'Maine', 'na.us.me.640' => 'Portland, Maine Area', 'na.us.md' => 'Maryland', 
        'na.us.md.7416' => 'Baltimore, Maryland Area', 'na.us.ma' => 'Massachusetts', 'na.us.ma.7' => 'Greater Boston Area', 'na.us.mi' => 'Michigan', 'na.us.mi.276' => 'Fort Wayne, Indiana Area', 'na.us.mi.35' => 'Greater Detroit Area', 'na.us.mi.300' => 'Greater Grand Rapids, Michigan Area', 'na.us.mi.372' => 'Kalamazoo, Michigan Area', 
        'na.us.mi.404' => 'Lansing, Michigan Area', 'na.us.mi.696' => 'Saginaw, Michigan Area', 'na.us.mn' => 'Minnesota', 'na.us.mn.512' => 'Greater Minneapolis-St. Paul Area', 'na.us.ms' => 'Mississippi', 'na.us.ms.76' => 'Baton Rouge, Louisiana Area', 'na.us.ms.556' => 'Greater New Orleans Area', 'na.us.ms.356' => 'Jackson, Mississippi Area', 
        'na.us.ms.516' => 'Mobile, Alabama Area', 'na.us.mo' => 'Missouri', 'na.us.mo.174' => 'Columbia, Missouri Area', 'na.us.mo.196' => 'Davenport, Iowa Area', 'na.us.mo.212' => 'Des Moines, Iowa Area', 'na.us.mo.258' => 'Fayetteville, Arkansas Area', 'na.us.mo.704' => 'Greater St. Louis Area', 'na.us.mo.376' => 'Kansas City, Missouri Area', 
        'na.us.mo.792' => 'Springfield, Missouri Area', 'na.us.mt' => 'Montana', 'na.us.ne' => 'Nebraska', 'na.us.ne.592' => 'Greater Omaha Area', 'na.us.ne.436' => 'Lincoln, Nebraska Area', 'na.us.nv' => 'Nevada', 'na.us.nv.412' => 'Las Vegas, Nevada Area', 'na.us.nv.672' => 'Reno, Nevada Area', 'na.us.nh' => 'New Hampshire', 'na.us.nj' => 'New Jersey', 
        'na.us.nm' => 'New Mexico', 'na.us.nm.20' => 'Albuquerque, New Mexico Area', 'na.us.ny' => 'New York', 'na.us.ny.16' => 'Albany, New York Area', 'na.us.ny.128' => 'Buffalo/Niagara, New York Area', 'na.us.ny.70' => 'Greater New York City Area', 'na.us.ny.684' => 'Rochester, New York Area', 'na.us.ny.816' => 'Syracuse, New York Area', 
        'na.us.nc' => 'North Carolina', 'na.us.nc.152' => 'Charlotte, North Carolina Area', 'na.us.nc.664' => 'Raleigh-Durham, North Carolina Area', 'na.us.nc.920' => 'Wilmington, North Carolina Area', 'na.us.nd' => 'North Dakota', 'na.us.oh' => 'Ohio','na.us.oh.21' => 'Cincinnati Area', 'na.us.oh.28' => 'Cleveland/Akron, Ohio Area', 
        'na.us.oh.184' => 'Columbus, Ohio Area', 'na.us.oh.200' => 'Dayton, Ohio Area', 'na.us.oh.840' => 'Toledo, Ohio Area', 'na.us.ok' => 'Oklahoma', 'na.us.ok.588' => 'Oklahoma City, Oklahoma Area', 'na.us.ok.856' => 'Tulsa, Oklahoma Area', 'na.us.or' => 'Oregon', 'na.us.or.240' => 'Eugene, Oregon Area', 'na.us.or.79' => 'Portland, Oregon Area', 
        'na.us.pa' => 'Pennsylvania', 'na.us.pa.24' => 'Allentown, Pennsylvania Area', 'na.us.pa.77' => 'Greater Philadelphia Area', 'na.us.pa.628' => 'Greater Pittsburgh Area', 'na.us.pa.324' => 'Harrisburg, Pennsylvania Area', 'na.us.pa.96' => 'Ithaca, New York Area', 'na.us.pa.400' => 'Lancaster, Pennsylvania Area', 'na.us.pa.756' => 'Scranton, Pennsylvania Area', 
        'na.us.ri' => 'Rhode Island', 'na.us.ri.648' => 'Providence, Rhode Island Area', 'na.us.sc' => 'South Carolina', 'na.us.sc.60' => 'Augusta, Georgia Area', 'na.us.sc.144' => 'Charleston, South Carolina Area', 'na.us.sc.176' => 'Columbia, South Carolina Area', 'na.us.sc.316' => 'Greenville, South Carolina Area', 'na.us.sc.752' => 'Savannah, Georgia Area', 
        'na.us.sd' => 'South Dakota', 'na.us.sd.776' => 'Sioux Falls, South Dakota Area', 'na.us.tn' => 'Tennessee', 'na.us.tn.48' => 'Asheville, North Carolina Area', 'na.us.tn.156' => 'Chattanooga, Tennessee Area', 'na.us.tn.492' => 'Greater Memphis Area', 'na.us.tn.536' => 'Greater Nashville Area', 'na.us.tn.344' => 'Huntsville, Alabama Area', 
        'na.us.tn.366' => 'Johnson City, Tennessee Area', 'na.us.tn.384' => 'Knoxville, Tennessee Area', 'na.us.tx' => 'Texas', 'na.us.tx.64' => 'Austin, Texas Area', 'na.us.tx.31' => 'Dallas/Fort Worth Area', 'na.us.tx.232' => 'El Paso, Texas Area', 'na.us.tx.42' => 'Houston, Texas Area', 'na.us.tx.724' => 'San Antonio, Texas Area', 
        'na.us.ut' => 'Utah', 'na.us.ut.716' => 'Greater Salt Lake City Area', 'na.us.ut.652' => 'Provo, Utah Area', 'na.us.vt' => 'Vermont', 'na.us.vt.130' => 'Burlington, Vermont Area', 'na.us.vt.800' => 'Springfield, Massachusetts Area', 'na.us.va' => 'Virginia', 'na.us.va.154' => 'Charlottesville, Virginia Area', 
        'na.us.va.312' => 'Greensboro/Winston-Salem, North Carolina Area', 'na.us.va.572' => 'Norfolk, Virginia Area', 'na.us.va.676' => 'Richmond, Virginia Area', 'na.us.va.680' => 'Roanoke, Virginia Area', 'na.us.wa' => 'Washington', 'na.us.wa.91' => 'Greater Seattle Area', 'na.us.wa.784' => 'Spokane, Washington Area', 
        'na.us.wv' => 'West Virginia', 'na.us.wi' => 'Wisconsin', 'na.us.wi.63' => 'Greater Milwaukee Area', 'na.us.wi.308' => 'Green Bay, Wisconsin Area', 'na.us.wi.472' => 'Madison, Wisconsin Area', 'na.us.wi.46' => 'Oshkosh, Wisconsin Area', 'na.us.wi.688' => 'Rockford, Illinois Area', 'na.us.wy' => 'Wyoming', 
        'oc' => 'Oceania', 'oc.au' => 'Australia', 'oc.au.*.4886' => 'Adelaide Area, Australia', 'oc.au.*.4909' => 'Brisbane Area, Australia', 'oc.au.*.4893' => 'Canberra Area, Australia', 'oc.au.*.4900' => 'Melbourne Area, Australia', 'oc.au.*.4905' => 'Perth Area, Australia', 'oc.au.*.4910' => 'Sydney Area, Australia', 'oc.nz' => 'New Zealand'
    ];
    
    const CONT = [
        "bd" => "Bangladesh", "be" => "Belgium", "bf" => "Burkina Faso", "bg" => "Bulgaria", "ba" => "Bosnia and Herzegovina", "bb" => "Barbados", "wf" => "Wallis and Futuna", "bl" => "Saint Barthelemy", "bm" => "Bermuda", "bn" => "Brunei", "bo" => "Bolivia", "bh" => "Bahrain", "bi" => "Burundi", "bj" => "Benin", "bt" => "Bhutan", "jm" => "Jamaica", "bv" => "Bouvet Island", "bw" => "Botswana", "ws" => "Samoa", "bq" => "Bonaire, Saint Eustatius and Saba ", "br" => "Brazil", "bs" => "Bahamas", "je" => "Jersey", "by" => "Belarus", "bz" => "Belize", "ru" => "Russia", "rw" => "Rwanda", "rs" => "Serbia", "tl" => "East Timor", "re" => "Reunion", "tm" => "Turkmenistan", "tj" => "Tajikistan", "ro" => "Romania", "tk" => "Tokelau", "gw" => "Guinea-Bissau", "gu" => "Guam", "gt" => "Guatemala", "gs" => "South Georgia and the South Sandwich Islands", "gr" => "Greece", "gq" => "Equatorial Guinea", "gp" => "Guadeloupe", "jp" => "Japan", "gy" => "Guyana", "gg" => "Guernsey", "gf" => "French Guiana", "ge" => "Georgia", "gd" => "Grenada", "gb" => "United Kingdom", "ga" => "Gabon", "sv" => "El Salvador", "gn" => "Guinea", "gm" => "Gambia", "gl" => "Greenland", "gi" => "Gibraltar", "gh" => "Ghana", "om" => "Oman", "tn" => "Tunisia", "jo" => "Jordan", "hr" => "Croatia", "ht" => "Haiti", "hu" => "Hungary", "hk" => "Hong Kong", "hn" => "Honduras", "hm" => "Heard Island and McDonald Islands", "ve" => "Venezuela", "pr" => "Puerto Rico", "ps" => "Palestinian Territory", "pw" => "Palau", "pt" => "Portugal", "sj" => "Svalbard and Jan Mayen", "py" => "Paraguay", "iq" => "Iraq", "pa" => "Panama", "pf" => "French Polynesia", "pg" => "Papua New Guinea", "pe" => "Peru", "pk" => "Pakistan", "ph" => "Philippines", "pn" => "Pitcairn", "pl" => "Poland", "pm" => "Saint Pierre and Miquelon", "zm" => "Zambia", "eh" => "Western Sahara", "ee" => "Estonia", "eg" => "Egypt", "za" => "South Africa", "ec" => "Ecuador", "it" => "Italy", "vn" => "Vietnam", "sb" => "Solomon Islands", "et" => "Ethiopia", "so" => "Somalia", "zw" => "Zimbabwe", "sa" => "Saudi Arabia", "es" => "Spain", "er" => "Eritrea", "me" => "Montenegro", "md" => "Moldova", "mg" => "Madagascar", "mf" => "Saint Martin", "ma" => "Morocco", "mc" => "Monaco", "uz" => "Uzbekistan", "mm" => "Myanmar", "ml" => "Mali", "mo" => "Macao", "mn" => "Mongolia", "mh" => "Marshall Islands", "mk" => "Macedonia", "mu" => "Mauritius", "mt" => "Malta", "mw" => "Malawi", "mv" => "Maldives", "mq" => "Martinique", "mp" => "Northern Mariana Islands", "ms" => "Montserrat", "mr" => "Mauritania", "im" => "Isle of Man", "ug" => "Uganda", "tz" => "Tanzania", "my" => "Malaysia", "mx" => "Mexico", "il" => "Israel", "fr" => "France", "io" => "British Indian Ocean Territory", "sh" => "Saint Helena", "fi" => "Finland", "fj" => "Fiji", "fk" => "Falkland Islands", "fm" => "Micronesia", "fo" => "Faroe Islands", "ni" => "Nicaragua", "nl" => "Netherlands", "no" => "Norway", "na" => "Namibia", "vu" => "Vanuatu", "nc" => "New Caledonia", "ne" => "Niger", "nf" => "Norfolk Island", "ng" => "Nigeria", "nz" => "New Zealand", "np" => "Nepal", "nr" => "Nauru", "nu" => "Niue", "ck" => "Cook Islands", "xk" => "Kosovo", "ci" => "Ivory Coast", "ch" => "Switzerland", "co" => "Colombia", "cn" => "China", "cm" => "Cameroon", "cl" => "Chile", "cc" => "Cocos Islands", "ca" => "Canada", "cg" => "Republic of the Congo", "cf" => "Central African Republic", "cd" => "Democratic Republic of the Congo", "cz" => "Czech Republic", "cy" => "Cyprus", "cx" => "Christmas Island", "cr" => "Costa Rica", "cw" => "Curacao", "cv" => "Cape Verde", "cu" => "Cuba", "sz" => "Swaziland", "sy" => "Syria", "sx" => "Sint Maarten", "kg" => "Kyrgyzstan", "ke" => "Kenya", "ss" => "South Sudan", "sr" => "Suriname", "ki" => "Kiribati", "kh" => "Cambodia", "kn" => "Saint Kitts and Nevis", "km" => "Comoros", "st" => "Sao Tome and Principe", "sk" => "Slovakia", "kr" => "South Korea", "si" => "Slovenia", "kp" => "North Korea", "kw" => "Kuwait", "sn" => "Senegal", "sm" => "San Marino", "sl" => "Sierra Leone", "sc" => "Seychelles", "kz" => "Kazakhstan", "ky" => "Cayman Islands", "sg" => "Singapore", "se" => "Sweden", "sd" => "Sudan", "do" => "Dominican Republic", "dm" => "Dominica", "dj" => "Djibouti", "dk" => "Denmark", "vg" => "British Virgin Islands", "de" => "Germany", "ye" => "Yemen", "dz" => "Algeria", "us" => "United States", "uy" => "Uruguay", "yt" => "Mayotte", "um" => "United States Minor Outlying Islands", "lb" => "Lebanon", "lc" => "Saint Lucia", "la" => "Laos", "tv" => "Tuvalu", "tw" => "Taiwan", "tt" => "Trinidad and Tobago", "tr" => "Turkey", "lk" => "Sri Lanka", "li" => "Liechtenstein", "lv" => "Latvia", "to" => "Tonga", "lt" => "Lithuania", "lu" => "Luxembourg", "lr" => "Liberia", "ls" => "Lesotho", "th" => "Thailand", "tf" => "French Southern Territories", "tg" => "Togo", "td" => "Chad", "tc" => "Turks and Caicos Islands", "ly" => "Libya", "va" => "Vatican", "vc" => "Saint Vincent and the Grenadines", "ae" => "United Arab Emirates", "ad" => "Andorra", "ag" => "Antigua and Barbuda", "af" => "Afghanistan", "ai" => "Anguilla", "vi" => "U.S. Virgin Islands", "is" => "Iceland", "ir" => "Iran", "am" => "Armenia", "al" => "Albania", "ao" => "Angola", "aq" => "Antarctica", "as" => "American Samoa", "ar" => "Argentina", "au" => "Australia", "at" => "Austria", "aw" => "Aruba", "in" => "India", "ax" => "Aland Islands", "az" => "Azerbaijan", "ie" => "Ireland", "id" => "Indonesia", "ua" => "Ukraine", "qa" => "Qatar", "mz" => "Mozambique"
    ];
    
    const SENIORITY = [
        '1' => 'Unpaid',
        '2' => 'Training',
        '3' => 'Entry-level',
        '4' => 'Senior',
        '5' => 'Manager',
        '6' => 'Director',
        '7' => 'Vice President (VP)',
        '8' => 'Chief X Officer (CxO)',
        '9' => 'Partner',
        '10' => 'Owner',
    ];
    
    const INDUSTRY = [
        '47' => 'Accounting',
        '94' => 'Airlines/Aviation',
        '120' => 'Alternative Dispute Resolution',
        '125' => 'Alternative Medicine',
        '127' => 'Animation',
        '19' => 'Apparel & Fashion',
        '50' => 'Architecture & Planning',
        '111' => 'Arts and Crafts',
        '53' => 'Automotive',
        '52' => 'Aviation & Aerospace',
        '41' => 'Banking',
        '12' => 'Biotechnology',
        '36' => 'Broadcast Media',
        '49' => 'Building Materials',
        '138' => 'Business Supplies and Equipment',
        '129' => 'Capital Markets',
        '54' => 'Chemicals',
        '90' => 'Civic & Social Organization',
        '51' => 'Civil Engineering',
        '128' => 'Commercial Real Estate',
        '118' => 'Computer & Network Security',
        '109' => 'Computer Games',
        '3' => 'Computer Hardware',
        '5' => 'Computer Networking',
        '4' => 'Computer Software',
        '48' => 'Construction',
        '24' => 'Consumer Electronics',
        '25' => 'Consumer Goods',
        '91' => 'Consumer Services',
        '18' => 'Cosmetics',
        '65' => 'Dairy',
        '1' => 'Defense & Space',
        '99' => 'Design',
        '69' => 'Education Management',
        '132' => 'E-Learning',
        '112' => 'Electrical/Electronic Manufacturing',
        '28' => 'Entertainment',
        '86' => 'Environmental Services',
        '110' => 'Events Services',
        '76' => 'Executive Office',
        '122' => 'Facilities Services',
        '63' => 'Farming',
        '43' => 'Financial Services',
        '38' => 'Fine Art',
        '66' => 'Fishery',
        '34' => 'Food & Beverages',
        '23' => 'Food Production',
        '101' => 'Fund-Raising',
        '26' => 'Furniture',
        '29' => 'Gambling & Casinos',
        '145' => 'Glass, Ceramics & Concrete',
        '75' => 'Government Administration',
        '148' => 'Government Relations',
        '140' => 'Graphic Design',
        '124' => 'Health, Wellness and Fitness',
        '68' => 'Higher Education',
        '14' => 'Hospital & Health Care',
        '31' => 'Hospitality',
        '137' => 'Human Resources',
        '134' => 'Import and Export',
        '88' => 'Individual & Family Services',
        '147' => 'Industrial Automation',
        '84' => 'Information Services',
        '96' => 'Information Technology and Services',
        '42' => 'Insurance',
        '74' => 'International Affairs',
        '141' => 'International Trade and Development',
        '6' => 'Internet',
        '45' => 'Investment Banking',
        '46' => 'Investment Management',
        '73' => 'Judiciary',
        '77' => 'Law Enforcement',
        '9' => 'Law Practice',
        '10' => 'Legal Services',
        '72' => 'Legislative Office',
        '30' => 'Leisure, Travel & Tourism',
        '85' => 'Libraries',
        '116' => 'Logistics and Supply Chain',
        '143' => 'Luxury Goods & Jewelry',
        '55' => 'Machinery',
        '11' => 'Management Consulting',
        '95' => 'Maritime',
        '97' => 'Market Research',
        '80' => 'Marketing and Advertising',
        '135' => 'Mechanical or Industrial Engineering',
        '126' => 'Media Production',
        '17' => 'Medical Devices',
        '13' => 'Medical Practice',
        '139' => 'Mental Health Care',
        '71' => 'Military',
        '56' => 'Mining & Metals',
        '35' => 'Motion Pictures and Film',
        '37' => 'Museums and Institutions',
        '115' => 'Music',
        '114' => 'Nanotechnology',
        '81' => 'Newspapers',
        '100' => 'Non-Profit Organization Management',
        '57' => 'Oil & Energy',
        '113' => 'Online Media',
        '123' => 'Outsourcing/Offshoring',
        '87' => 'Package/Freight Delivery',
        '146' => 'Packaging and Containers',
        '61' => 'Paper & Forest Products',
        '39' => 'Performing Arts',
        '15' => 'Pharmaceuticals',
        '131' => 'Philanthropy',
        '136' => 'Photography',
        '117' => 'Plastics',
        '107' => 'Political Organization',
        '67' => 'Primary/Secondary Education',
        '83' => 'Printing',
        '105' => 'Professional Training & Coaching',
        '102' => 'Program Development',
        '79' => 'Public Policy',
        '98' => 'Public Relations and Communications',
        '78' => 'Public Safety',
        '82' => 'Publishing',
        '62' => 'Railroad Manufacture',
        '64' => 'Ranching',
        '44' => 'Real Estate',
        '40' => 'Recreational Facilities and Services',
        '89' => 'Religious Institutions',
        '144' => 'Renewables & Environment',
        '70' => 'Research',
        '32' => 'Restaurants',
        '27' => 'Retail',
        '121' => 'Security and Investigations',
        '7' => 'Semiconductors',
        '58' => 'Shipbuilding',
        '20' => 'Sporting Goods',
        '33' => 'Sports',
        '104' => 'Staffing and Recruiting',
        '22' => 'Supermarkets',
        '8' => 'Telecommunications',
        '60' => 'Textiles',
        '130' => 'Think Tanks',
        '21' => 'Tobacco',
        '108' => 'Translation and Localization',
        '92' => 'Transportation/Trucking/Railroad',
        '59' => 'Utilities',
        '106' => 'Venture Capital & Private Equity',
        '16' => 'Veterinary',
        '93' => 'Warehousing',
        '133' => 'Wholesale',
        '142' => 'Wine and Spirits',
        '119' => 'Wireless',
        '103' => 'Writing and Editing'
    ];
    
    const JOB = [
        '-1' => 'None',
        '1' => 'Accounting',
        '2' => 'Administrative',
        '3' => 'Arts and Design',
        '4' => 'Business Development',
        '5' => 'Community & Social Services',
        '6' => 'Consulting',
        '7' => 'Education',
        '8' => 'Engineering',
        '9' => 'Entrepreneurship',
        '10' => 'Finance',
        '11' => 'Healthcare Services',
        '12' => 'Human Resources',
        '13' => 'Information Technology',
        '14' => 'Legal',
        '15' => 'Marketing',
        '16' => 'Media & Communications',
        '17' => 'Military & Protective Services',
        '18' => 'Operations',
        '19' => 'Product Management',
        '20' => 'Program & Product Management',
        '21' => 'Purchasing',
        '22' => 'Quality Assurance',
        '23' => 'Real Estate',
        '24' => 'Rersearch',
        '25' => 'Sales',
        '26' => 'Support'
    ];
    
    /**
     * Set instagram client session 
     **/
    public function setClient($client){
        Yii::$app->session->set('linkedin', $client);
    }
    
    /**
     * get instagram client session 
     **/
    public function getClient(){
        $client = Yii::$app->session->get('linkedin');
        if(Yii::$app->session->get('linkedin')){
            return Yii::$app->session->get('linkedin');
        }else{
            echo 'It looks like you need to login again !'; die;
        }
    }
    
    public function getUserAdminCompanies(){
        $client = $this->getClient();
        $companies = $client->api('companies?format=json&is-company-admin=true');
        return $companies;
    }
    
    public function getCompanyData($company_id){
        $client = $this->getClient();
        $company_data = $client->api('companies/'.$company_id.':(id,name,logo-url,num-followers)?format=json');
        return $company_data;
    }
    
    public function createCompanyModel($data, $authclient_id){
        $oAccountModel = new Model();
        $oAccountModel->authclient_id = $authclient_id;
        $oAccountModel->entity_id = $data["id"];
        $oAccountModel->type = self::ACCOUNT;
        $oAccountModel->name = $data["name"];
        $oAccountModel->media_url = $data["logoUrl"];
        $oAccountModel->followers = $data["numFollowers"];
        $oAccountModel->save();
        return $oAccountModel;
    }
    
    public function getCompanyUpdates($company_id){
        $client = $this->getClient();
        $company_updates = $client->api('companies/'.$company_id.'/updates?format=json');
        return $company_updates;
    }
    
    public function createUpdateModel($parent_id, $authclient_id, $update){
        $oUpdateModel = new Model();
        $oUpdateModel->authclient_id = $authclient_id;
        $oUpdateModel->parent_id = $parent_id;
        $oUpdateModel->entity_id = $update['updateKey'];
        $oUpdateModel->type = self::POST;
        $oUpdateModel->content = $update['updateContent']['companyStatusUpdate']['share']['content']['description'];
        $oUpdateModel->media_url = $update['updateContent']['companyStatusUpdate']['share']['content']['thumbnailUrl'];
        $oUpdateModel->likes = $update['numLikes'];
        $oUpdateModel->comments = $update['updateComments']['_total'];
        $oUpdateModel->creation_time = (($update['timestamp'])/1000);
        if(!$oUpdateModel->save()){
            echo '<pre>'; var_dump($oUpdateModel->getErrors()); echo '</pre>'; die;
        }
    }
    
    public function getUpdateStatisticsInTime($company_id, $update_key, $since){
        $client = $this->getClient();
        $company_update_statistics = $client->api('companies/'.$company_id.'/historical-status-update-statistics:(click-count,like-count,comment-count,impression-count,share-count,time)?update-key='.$update_key.'&time-granularity=day&start-timestamp='.$since.'&format=json');
        return $company_update_statistics;
    }
    
    public function getHistoricalStatisticsInTime($company_id, $since){
        $client = $this->getClient();
        $company_update_statistics = $client->api('companies/'.$company_id.'/historical-status-update-statistics:(click-count,like-count,comment-count,impression-count,share-count,time)?time-granularity=day&start-timestamp='.$since.'&format=json');
        return $company_update_statistics;
    }
    
    public function getHistoricalFollowersStatisticsInTime($company_id, $since){
        $client = $this->getClient();
        $company_followers_statistics = $client->api('companies/'.$company_id.'/historical-follow-statistics?time-granularity=day&start-timestamp='.$since.'&format=json');
        //echo '<pre>'; var_dump($company_followers_statistics); echo '</pre>'; die;
        return $company_followers_statistics;
    }
    
    public function getCompanyStatistics($company_id = '5260201'){
        $client = $this->getClient();
        $company_statistics = $client->api('companies/'.$company_id.'/company-statistics?format=json');
        //echo '<pre>'; var_dump($company_statistics); echo '</pre>'; die;
        return $company_statistics;
    }
    
    public function firstTimeToLog($company_id, $authclient_id){
        $company_data = $this->getCompanyData($company_id);
        $oAccountModel = $this->createCompanyModel($company_data, $authclient_id);
        $company_updates = $this->getCompanyUpdates($company_id);
        foreach($company_updates['values'] as $update){
            $this->createUpdateModel($oAccountModel->id, $authclient_id, $update);
        }
        return $oAccountModel;
    }
    
    public function getUpdatesStatistics($company_id, $updates, $since, $until){
        $updates_statistics = [];
        foreach($updates as $oUpdate){
            $update_statistics = $this->getUpdateStatisticsInTime($company_id, $oUpdate->entity_id, $since)['values'];
            $updates_statistics[$oUpdate->entity_id] = ['statistics' => $update_statistics, 'likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0, 'clicks' => 0];
            foreach($update_statistics as $statistics){
                $updates_statistics[$oUpdate->entity_id]['likes'] += $statistics['likeCount'];
                $updates_statistics[$oUpdate->entity_id]['comments'] += $statistics['commentCount'];
                $updates_statistics[$oUpdate->entity_id]['shares'] += $statistics['shareCount'];
                $updates_statistics[$oUpdate->entity_id]['impressions'] += $statistics['impressionCount'];
                $updates_statistics[$oUpdate->entity_id]['clicks'] += $statistics['clickCount'];
            }
        }
        return $updates_statistics;
    }
    
    public function getSumsOfAllUpdatesStatistics($updates_statistics){
        $sum = ['likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0, 'clicks' => 0, 'interactions' => 0];
        foreach($updates_statistics as $statistics){
            $sum['likes'] += $statistics['likes'];
            $sum['comments'] += $statistics['comments'];
            $sum['shares'] += $statistics['shares'];
            $sum['impressions'] += $statistics['impressions'];
            $sum['clicks'] += $statistics['clicks'];
        }
        $sum['interactions'] = $sum['likes'] + $sum['comments'] + $sum['shares'];
        return $sum;
    }
    
    public function statistics($oModel){
        $since = strtotime('-10 months') * 1000;
        $until = time() * 1000;
        $historical_statistics = $this->getHistoricalStatisticsInTime($oModel->entity_id, $since)['values'];
        $days = [];
        $statistics_array = ['clicks' => 0, 'likes' => 0, 'comments' => 0, 'shares' => 0, 'impressions' => 0, 'days' => []];
        $company_views_statistics_by_day = [];
        foreach($historical_statistics as $statistics){
            $statistics_array['clicks'] += $statistics['clickCount'];
            $statistics_array['likes'] += $statistics['likeCount'];
            $statistics_array['comments'] += $statistics['commentCount'];
            $statistics_array['shares'] += $statistics['shareCount'];
            $statistics_array['impressions'] += $statistics['impressionCount'];
            $day_in_str = date('d M', (($statistics['time'])/1000));
            array_push($days, $day_in_str);
            $company_views_statistics_by_day[$day_in_str]['impressions'] = $statistics['impressionCount'];
            $company_views_statistics_by_day[$day_in_str]['shares'] = $statistics['shareCount'];
            $company_views_statistics_by_day[$day_in_str]['comments'] = $statistics['commentCount'];
            $company_views_statistics_by_day[$day_in_str]['likes'] = $statistics['likeCount'];
            $company_views_statistics_by_day[$day_in_str]['clicks'] = $statistics['clickCount'];
            $company_views_statistics_by_day[$day_in_str]['interactions'] = $company_views_statistics_by_day[$day_in_str]['shares'] + $company_views_statistics_by_day[$day_in_str]['likes'] + $company_views_statistics_by_day[$day_in_str]['comments'] = $statistics['commentCount'];
        }
        $statistics_array['company_views_statistics_by_day'] = $company_views_statistics_by_day;
        $statistics_array['days'] = $days;
        $days_max_index = count($days) - 1;
        $statistics_array['interactions'] = $statistics_array['likes'] + $statistics_array['comments'] + $statistics_array['shares'];
        $statistics_array['followers'] = $this->getHistoricalFollowersStatisticsInTime($oModel->entity_id, $since);
        $statistics_array['new_followers'] = $statistics_array['followers']['values'][$days_max_index]['totalFollowerCount'] - $statistics_array['followers']['values'][0]['totalFollowerCount'];
        $statistics_array['total_followers'] = $statistics_array['followers']['values'][$days_max_index]['totalFollowerCount'];
        $statistics_array['organic_followers'] = $statistics_array['followers']['values'][$days_max_index]['organicFollowerCount'];
        $statistics_array['paid_followers'] = $statistics_array['followers']['values'][$days_max_index]['paidFollowerCount'];
        $statistics_array['updates'] = Model::find()->Where(['parent_id' => $oModel->id])->andWhere(['between', 'creation_time', $since, $until])->all();
        $statistics_array['avg_daily_updates'] = (count($statistics_array['updates']) != 0) ? round(((count($statistics_array['updates']))/count($days)), 1) : 0;
        $statistics_array['avg_daily_reach'] = ($statistics_array['impressions'] != 0) ? round((($statistics_array['impressions'])/count($days)), 1) : 0;
        $statistics_array['avg_daily_interactions'] = ($statistics_array['interactions'] != 0) ? round((($statistics_array['interactions'])/count($days)), 1) : 0;
        $statistics_array['updates_statistics'] = $this->getUpdatesStatistics($oModel->entity_id, $statistics_array['updates'], $since, $until);
        $statistics_array['updates_statistics_by_day'] = $this->getUpdatesStatisticsByDay($statistics_array['days'], $statistics_array['updates'], $statistics_array['updates_statistics']);
        $statistics_array['sums_of_all_updates_statistics'] = $this->getSumsOfAllUpdatesStatistics($statistics_array['updates_statistics']);
        $statistics_array['followers_array'] = $this->getFollowersArray($statistics_array['followers']['values']);
        $statistics_array['company_statistics'] = $this->getCompanyStatistics($oModel->entity_id);
        return $statistics_array;
    }
    
    public function getUpdatesStatisticsByDay($days, $updates, $updates_statistics){
        foreach($days as $day){
            $update_statistics_by_day[$day] = ['new_updates' => 0, 'new_likes' => 0, 'new_comments' => 0, 'new_shares' => 0, 'new_interactions' => 0, 'new_impressions' => 0, 'new_clicks' => 0];
            foreach($updates as $oUpdate){
                if(date('d M', $oUpdate->creation_time) == $day){
                    $update_statistics_by_day[$day]['new_updates']++;
                    $update_statistics_by_day[$day]['new_likes'] += $updates_statistics[$oUpdate->entity_id]['likes'];
                    $update_statistics_by_day[$day]['new_comments'] += $updates_statistics[$oUpdate->entity_id]['comments'];
                    $update_statistics_by_day[$day]['new_shares'] += $updates_statistics[$oUpdate->entity_id]['shares'];
                    $update_statistics_by_day[$day]['new_interactions'] += ($update_statistics_by_day[$day]['new_likes'] + $update_statistics_by_day[$day]['new_comments'] + $update_statistics_by_day[$day]['new_shares']);
                    $update_statistics_by_day[$day]['new_impressions'] += $updates_statistics[$oUpdate->entity_id]['impressions'];
                    $update_statistics_by_day[$day]['new_clicks'] += $updates_statistics[$oUpdate->entity_id]['clicks'];
                }
            }
        }
        return $update_statistics_by_day;
    }
    
    public function getUpdatesByDayJsonTable($updates_by_day_statistics){
        $updates_by_day_json_table = ($updates_by_day_statistics) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'updates', $updates_by_day_statistics, 'new_updates') : '';
        return $updates_by_day_json_table;
    }
    
    public function getInteractionsByDayJsonTable($days, $update_statistics_by_day, $company_views_statistics_by_day){
        $interactions_by_day_json_table = (($update_statistics_by_day) && ($company_views_statistics_by_day)) ? GoogleChartHelper::getTwoGraphsByDayDataTableUsingKeyNames('day', 'new interactions', 'total interactions', $days, $update_statistics_by_day, 'new_interactions', $company_views_statistics_by_day, 'interactions') : '';
        return $interactions_by_day_json_table;
    }
    
    public function getInteractionsDistributionByDayJsonTable($statistics){
        $interactions_distribution_by_day_json_table = ($statistics) ? GoogleChartHelper::getSameArrayThreeValuesDataTableUsingKeyNames('day', 'likes', 'comments', 'shares', $statistics, 'likes', 'comments', 'shares') : '';
        return $interactions_distribution_by_day_json_table;
    }
    
    public function getClicksByDayJsonTable($statistics){
        $clicks_by_day_json_table = ($statistics) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'clicks', $statistics, 'clicks') : '';
        return $clicks_by_day_json_table;
    }
    
    public function getImpressionsByDayJsonTable($statistics){
        $impressions_by_day_json_table = ($statistics) ? GoogleChartHelper::getKeyValueDataTableWithValueKeyName('day', 'impressions', $statistics, 'impressions') : '';
        return $impressions_by_day_json_table;
    }
    
    public function getFollowersArray($followers){
        $followers_array = [];
        foreach($followers as $day){
            $day_t = date('d M', ($day['time']/1000));
            $followers_array[$day_t]['total'] = $day['totalFollowerCount'];
            $followers_array[$day_t]['organic'] = $day['organicFollowerCount'];
            $followers_array[$day_t]['paid'] = $day['paidFollowerCount'];
        }
        return $followers_array;
    }
    
    public function getFollowersByDayJsonTable($followers){
        $followers_by_day_json_table = ($followers) ? GoogleChartHelper::getSameArrayThreeValuesDataTableUsingKeyNames('day', 'total', 'organic', 'paid', $followers, 'total', 'organic', 'paid') : '';
        return $followers_by_day_json_table;
    }
    
    public function getCompanySize($followers_company_size_statistics){
        $company_size_statistics = [];
        foreach($followers_company_size_statistics as $value){
            $company_size_statistics[self::COMPANYSIZE[$value['entryKey']]] = $value['entryValue'];
        }
        return $company_size_statistics;
    }
    
    public function getCompanySizeJsonTable($company_size_statistics){
        $company_size_statistics_json_table = ($company_size_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $company_size_statistics) : '';
        return $company_size_statistics_json_table;
    }
    
    public function getCountry($followers_country_statistics){
        $country_statistics = [];
        foreach($followers_country_statistics as $value){
            $country_statistics[self::CONT[$value['entryKey']]] = $value['entryValue'];
        }
        return $country_statistics;
    }
    
    public function getCountryJsonTable($country_statistics){
        $country_statistics_json_table = ($country_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $country_statistics) : '';
        return $country_statistics_json_table;
    }
    
    public function getSeniority($followers_seniority_statistics){
        $seniority_statistics = [];
        foreach($followers_seniority_statistics as $value){
            $seniority_statistics[self::SENIORITY[$value['entryKey']]] = $value['entryValue'];
        }
        return $seniority_statistics;
    }
    
    public function getSeniorityJsonTable($seniority_statistics){
        $seniority_statistics_json_table = ($seniority_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $seniority_statistics) : '';
        return $seniority_statistics_json_table;
    }
    
    public function getIndustry($followers_industry_statistics){
        $industry_statistics = [];
        foreach($followers_industry_statistics as $value){
            $industry_statistics[self::INDUSTRY[$value['entryKey']]] = $value['entryValue'];
        }
        return $industry_statistics;
    }
    
    public function getIndustryJsonTable($industry_statistics){
        $industry_statistics_json_table = ($industry_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $industry_statistics) : '';
        return $industry_statistics_json_table;
    }
    
    public function getJobs($followers_job_statistics){
        $job_statistics = [];
        foreach($followers_job_statistics as $value){
            $job_statistics[self::JOB[$value['entryKey']]] = $value['entryValue'];
        }
        return $job_statistics;
    }
    
    public function getJobsJsonTable($job_statistics){
        $job_statistics_json_table = ($job_statistics) ? GoogleChartHelper::getDataTable('company size', 'employee', $job_statistics) : '';
        return $job_statistics_json_table;
    }
    
}