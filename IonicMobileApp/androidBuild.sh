#/bin/bash

ionic build android --release

jarsigner -verbose -storepass aragorn1 -sigalg SHA1withRSA -digestalg SHA1 -keystore ~/Development/EEAPMobile/android.keystore /Users/Dad/Development/TheSafetyPickle/IonicMobileApp/platforms/android/build/outputs/apk/android-release-unsigned.apk phonegap

zipalign -f -v 4 /Users/Dad/Development/TheSafetyPickle/IonicMobileApp/platforms/android/build/outputs/apk/android-release-unsigned.apk released_binaries/android-release.apk
