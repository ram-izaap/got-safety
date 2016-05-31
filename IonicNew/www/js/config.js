var pdfurls = [];

pdfurls['lesson']   = 'http://localhost/got_safety/assets/images/admin/lession_attachment/'
pdfurls['logs']     = 'http://localhost/got_safety/assets/images/frontend/logs/';
pdfurls['reports']  = 'http://localhost/got_safety/assets/images/frontend/inspection_reports/';
pdfurls['records']  = 'http://localhost/got_safety/assets/images/frontend/records/';
pdfurls['docs'] 	= 'http://localhost/got_safety/assets/images/frontend/call_osha/';
pdfurls['forms']    = 'http://localhost/got_safety/assets/images/frontend/safety_forms/';
pdfurls['posters']  = 'http://localhost/got_safety/assets/images/frontend/posters_attachment/';

angular.module('starter.constants',[])  
  .constant('AppConfig',{'apiUrl': 'http://localhost/got_safety/service/'})
  .constant('pdfUrls',pdfurls);