import urllib, json
url = 'https://sonarcloud.io/api/qualitygates/project_status?projectKey=PhpKonf'
response = urllib.urlopen(url)
data = json.loads(response.read())
status = data['projectStatus']['status']
if status == 'OK':
	print 'Sonar Quality check is OK.'
elif status == 'WARN':
	print 'Sonar Quality check is Warning... Please check https://sonarcloud.io/dashboard?id=PhpKonf'
else:
	print 'Sonar Quality check is Failed.'
	sys.exit(1)