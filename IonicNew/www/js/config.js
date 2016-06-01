var pdfurls = [];

pdfurls['lesson']   = 'http://izaapinnovations.com/got_safety/assets/images/admin/lession_attachment/'
pdfurls['logs']     = 'http://izaapinnovations.com/got_safety/images/frontend/logs/';
pdfurls['reports']  = 'http://izaapinnovations.com/got_safety/assets/images/frontend/inspection_reports/';
pdfurls['records']  = 'http://izaapinnovations.com/got_safety/assets/images/frontend/records/';
pdfurls['docs'] 	= 'http://izaapinnovations.com/got_safety/assets/images/frontend/call_osha/';
pdfurls['forms']    = 'http://izaapinnovations.com/got_safety/assets/images/frontend/safety_forms/';
pdfurls['posters']  = 'http://izaapinnovations.com/got_safety/assets/images/frontend/posters_attachment/';

angular.module('starter.constants',[])  
  .constant('AppConfig',{'apiUrl': 'http://izaapinnovations.com/got_safety/service/'})
  .constant('pdfUrls',pdfurls);