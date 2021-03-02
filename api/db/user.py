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

	def login(self, username, password):
		r = requests.get(urljoin(host, wp_user_auther), params={'login': username, 'password': password})
		js = json.loads(r.text)
		if js:
			self.id = js[0]['ID']
			self.username = js[0]['user_login']
			self.password = password
			self.password_hashed = js[0]['user_pass']
			self.email = js[0]['user_email']
			return self
		return None

	def __str__(self):
		return "<User " + str(self.username) + " with id = " + str(self.id) + ">"