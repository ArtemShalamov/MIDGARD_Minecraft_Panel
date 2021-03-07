from flask import Flask, render_template, request, redirect
from api.db.user import User
import config

app = Flask(__name__, template_folder='frontend', static_folder='static')

<<<<<<< Updated upstream
@app.route('/', methods=["GET", "POST"])
def index():
	if request.cookies.get('user_pass') and request.cookies.get('user_name'):
		if request.method == "POST":
			if request.form.get("form-type") == "change_profile":
				user = User().login(request.cookies.get('user_name'), request.cookies.get('user_pass'))
				user.update(request.form.get("user_url"), request.form.get("user_desc"))
		user = User().login(request.cookies.get('user_name'), request.cookies.get('user_pass'))
		return render_template('frontend/user.html', user=user, config=config)
	return redirect('login')

@app.route('/login', methods=["GET", "POST"])
@app.route('/login.html', methods=["GET", "POST"])
@app.route('/login.htm', methods=["GET", "POST"])
def login():
	if request.method == "POST":
		user = User()
		user = user.login(request.form.get('login'), request.form.get('password'))
		res = redirect('/')
		res.set_cookie('user_pass', user.password, max_age=60 * 60 * 24 * 365 * 2)
		res.set_cookie('user_name', user.username, max_age=60 * 60 * 24 * 365 * 2)
		return res
	return render_template('login/index.html')

@app.route('/user.html')
@app.route('/user')
@app.route('/user.html')
def userR():
	return redirect('/')

@app.route('/dashboard')
@app.route('/dashboard.htm')
@app.route('/dashboard.html')
def dashboard():
	user = User().login(request.cookies.get('user_name'), request.cookies.get('user_pass'))
	return render_template('frontend/dashboard.html', user=user, config=config)
=======
app = Flask(__name__, template_folder='frontend')
>>>>>>> Stashed changes

if __name__ == "__main__":
	app.run(port=80, debug=True)