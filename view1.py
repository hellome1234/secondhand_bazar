# in view.py


def csv_upload(request)
	template = "csv_upload.html"


	prompt = {
	'order_csv' :'Order of csv should be Flower Name,Scientist Name,Season,Fertilizer,Nurseries Nname'}

	if request.method == 'GET':
		return render(request, template, prompt)

	csv_file = request.FILES['file']

	# check if the file is csv or not
	if not csv_file.name.endswidth('.csv'): 
			messages.error(request,"This is not a csv file")



	#reads the csv file and decode it.		
	data_set = csv_file.read().decode('UTF-8')
	io_string = io.StringIO(data_set)
	# Use to skip the first line as it contains column name.
	next(io_string)
	for row in csv.reader(io_string,delimiter=',',quotechar="|" ):
		#creates Flower database
		created = Flower.objects.update_or_create(
				SN = row[0],
				Flower_Name = row[1],
				Scientist_Name = row[2],
				Season = row[3],
				Fertilizer =row[4],
				Nurseries_Name = row[5]
			)

		return render(request,template)