from urllib.parse import urljoin
from config import *
import requests
import json
import utils.exceptions.server


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

	skinAvailable, cloakAvailable = True, False

	def login(self, username, password):
		r = requests.get(urljoin(host, wp_user_auther), params={'login': username, 'password': password})
		try:
			js = json.loads(r.text)
		except json.decoder.JSONDecodeError:
			raise utils.exceptions.server.JSONServerError("Server returned " + r.text + " is not json")
		if js is not []:
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

			self.skinAvailable = bool(int(js[0]['skinAvailable']))
			self.cloakAvailable = bool(int(js[0]['cloakAvailable']))
			return self
		return None

	def update(self, user_url, user_desc):
		r = requests.get(urljoin(host, wp_user_profile_changer), params={"login" : self.username, "password": self.password, "user_site": user_url, "user_desc": user_desc})

		if r.text == "OK":
			return True
		else:
			raise utils.exceptions.server.ChangeProfileError("Server returned " + r.text + " is not OK")

	def __str__(self):
		return f"<User {self.raw_data} >"