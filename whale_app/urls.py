from django.urls import path
from .views import *

urlpatterns = [     
    path('', TapCoinView.as_view(), name='tap_coin'),
    path('telegram-auth/', telegram_auth, name='telegram_auth'),  # Endpoint to handle Telegram auth
    path('claim-reward/', ClaimRewardView.as_view(), name='claim_reward'),
    path('register-wallet/', RegisterWalletView.as_view(), name='register_wallet'),
]
