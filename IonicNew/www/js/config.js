var pdfurls = [];

pdfurls['lesson']   = 'http://localhost/got-safety/assets/images/admin/lession_attachment/'
pdfurls['logs']     = 'http://localhost/got-safety/assets/images/frontend/logs/';
pdfurls['reports']  = 'http://localhost/got-safety/assets/images/frontend/inspection_reports/';
pdfurls['records']  = 'http://localhost/got-safety/assets/images/frontend/records/';
pdfurls['docs'] 	= 'http://localhost/got-safety/assets/images/frontend/call_osha/';
pdfurls['forms']    = 'http://localhost/got-safety/assets/images/frontend/safety_forms/';
pdfurls['posters']  = 'http://localhost/got-safety/assets/images/frontend/posters_attachment/';

angular.module('starter.constants',[])  
  .constant('AppConfig',{'apiUrl': 'http://localhost/got-safety/service/'})
  .constant('pdfUrls',pdfurls);