import hashlib
import hmac
import time

from django.conf import settings

def verify_telegram_authentication(data):
    """Verifies the Telegram authentication response."""
    auth_data = data.copy()
    auth_data.pop('hash')  # Remove 'hash' from the data for verification
    
    # Sort the data and form a string with key=value pairs
    data_check_string = '\n'.join(f'{k}={v}' for k, v in sorted(auth_data.items()))
    
    secret_key = hmac.new(
        key=b'SHA256' + settings.TELEGRAM_BOT_TOKEN.encode(),
        msg=data_check_string.encode(),
        digestmod=hashlib.sha256
    ).hexdigest()
    
    # Compare the calculated hash with the provided one
    return secret_key == data['hash'] and int(data['auth_date']) > (time.time() - 86400)
