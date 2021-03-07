class JSONServerError(Exception):
	def __init__(self, message):
		super().__init__(message)

class ChangeProfileError(Exception):
	def __init__(self, message):
		super().__init__(message)