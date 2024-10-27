from django.contrib.auth.models import User
from django.db import models

class UserProfile(models.Model):
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    telegram_username = models.CharField(max_length=255, unique=True)
    telegram_id = models.CharField(max_length=100, unique=True)

    def __str__(self):
        return self.telegram_username

class Coin(models.Model):
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    coins = models.PositiveIntegerField(default=0)

    def __str__(self):
        return f'{self.user.username} - {self.coins} coins'

class Referral(models.Model):
    referrer = models.ForeignKey(User, related_name='referrals', on_delete=models.CASCADE)
    referred_user = models.OneToOneField(User, related_name='referred_by', on_delete=models.CASCADE)
    referral_bonus = models.PositiveIntegerField(default=0)

    def __str__(self):
        return f'{self.referrer} referred {self.referred_user}'
    
class Reward(models.Model):
    user = models.ForeignKey(User, on_delete=models.CASCADE)
    coins_required = models.PositiveIntegerField(default=0)
    reward_status = models.BooleanField(default=False)  # True when admin allows reward claim

    def __str__(self):
        return f'Reward for {self.user.username}'

class WalletAddress(models.Model):
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    wallet_address = models.CharField(max_length=255, unique=True)

    def __str__(self):
        return f'Wallet for {self.user.username}: {self.wallet_address}'
