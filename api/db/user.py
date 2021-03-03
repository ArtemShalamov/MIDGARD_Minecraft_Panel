from urllib.parse import urljoin
from config import *
import requests
import json


# Wordpress user
class User:
	id : int = 0
	username : str = ""
	password : str = "" # Not Hashed
	password_hashed : str = ""
	email : str = ""
	raw_data : dict = {}
	register_date : str = ""

	roleName : str = ""
	roleColor : str = ""
	user_desc : str = ""

	def login(self, username, password):
		r = requests.get(urljoin(host, wp_user_auther), params={'login': username, 'password': password})
		js = json.loads(r.text)

		if js:
			self.id = js[0]['ID']
			self.username = js[0]['user_login']
			self.password = password
			self.password_hashed = js[0]['user_pass']
			self.email = js[0]['user_email']
			self.raw_data = js[0]
			self.register_date = js[0]['user_registered']

			self.roleName = js[0]['roleName']
			self.roleColor = js[0]['roleColor']
			self.user_desc = js[0]['userdes']
			return self
		return None

	def __str__(self):
		return f"<User {self.raw_data} >"