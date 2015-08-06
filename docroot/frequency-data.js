function r1(n) { return( Math.floor( n*10 ) / 10 ); }
frequencyData = 
[{'name': 'Heartbeat',
  'interval': 60/70,
  'snippet': "Average resting heartbeat is 60-80 BPM.\n\nSource: http://en.wikipedia.org/wiki/Heart_rate#Basal_heart_rate\n\nRate: every "+r1( 60/70 )+" sec\nor 60 sec / 70 beats"
 },
 {'name': 'Someone in the US Gets Married',
  'interval': (86400 * 365) / 2118000,
  'snippet': "US marriages in 2011: 2,118,000\n\nSource: http://www.cdc.gov/nchs/nvss/marriage_divorce_tables.htm\n\nRate = every "+r1( (86400 * 365) / 2118000 )+" sec\nor seconds in a year (86400 * 365) / 2077000"
 },
 {'name': 'Someone in the US Gets Divorced',
  'interval': (86400 * 365) / 877000,
  'snippet': "US divorces in 2011: 877,000\n\nSource: http://www.cdc.gov/nchs/nvss/marriage_divorce_tables.htm\n\nRate = every "+r1( (86400 * 365) / 877000 )+" sec\nor seconds in a year (86400 * 365) / 877000"
 },
 {'name': 'Domain Registered',
  'interval': 86400 / 100340,
  'snippet': "100,340 domains registered on Mar 17, 2014.\n\nSource: http://www.whois.sc/internet-statistics/\n\nRate: every "+r1( 86400 / 100340 )+" sec\nor 86400 seconds (1 day) / 100340 domains"
 },
 {'name': 'Lightning Strikes 10 Times Somewhere',
  'interval': 10 / 44,
  'snippet': "44 strikes per second +-5.\n\nSource: http://books.google.com/books?id=-mwbAsxpRr0C&pg=PA452&hl=en#v=onepage&q&f=false/\n\nRate: every "+r1( 10 / 44 )+" sec\nor 10 seconds / 44 lightning strikes"
 },
 {'name': 'A Species Becomes Extinct',
  'interval': (86400 * 365) / 10000,
  'snippet': "10,000 extinctions per year.\n\nSource: http://wwf.panda.org/about_our_earth/biodiversity/biodiversity/\n\nRate: every "+r1( (24 * 365) / 10000 )+" hr\nor hours in a year (86400 * 365) / 10000"
 },
 {'name': 'Drop Falls in the Pitch Drop Experiment',
  'interval': (70.5 * 365 * 86400) / 8,
  'snippet': "8 Drops have fallen between stem cut in 1930 and Nov 28, 2000.\n\nSource: http://oldsite.smp.uq.edu.au/pitch/pitchPaper.shtml\n\nRate: every "+r1( (70.5) / 8 )+" years or 70.5 years* / 8\n* estimate as we don't know the date in 1930 when it was cut."
 },
 {'name': 'Someone in the US buys a New Car',
  'interval': (86400 * 365) / 14550000,
  'snippet': "14.55 Million cars sold in 2010.\n\nSource: http://www.rita.dot.gov/bts/sites/rita.dot.gov.bts/files/publications/national_transportation_statistics/html/table_01_17.html\n\nRate: every "+r1( (86400 * 365) / 14550000 )+" sec\nor seconds in a year (86400 * 365) / 14,550,000"
 },
 {'name': 'Someone in the US buys a Used Car',
  'interval': (86400 * 365) / 36884000,
  'snippet': "36.88 Million cars sold in 2010.\n\nSource: http://www.rita.dot.gov/bts/sites/rita.dot.gov.bts/files/publications/national_transportation_statistics/html/table_01_17.html\n\nRate: every "+r1( (86400 * 365) / 36884000 )+" sec\nor seconds in a year (86400 * 365) / 36,884,000"
 },
 {'name': 'Apple Sells 10 iOS Devices',
  'interval': (86400 * 365) / 188691000 * 10,
  'snippet': "188,691,000 iOS Devices sold in 2013.\n\nSource: http://www.macworld.com/article/2058332/apple-revenues-up-but-net-profits-down-in-fourth-quarter.html\n\nRate: every "+r1( (86400 * 365) / (188691000 / 10) )+" sec\nor seconds in a year (86400 * 365) / 18,869,1000 / 10"
 }
];