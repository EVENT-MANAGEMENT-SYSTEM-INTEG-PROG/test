import React from "react";
import { SafeAreaView, ImageBackground, StyleSheet, Image } from "react-native";
import { Text, Button } from "react-native-paper";
import { useNavigation } from "@react-navigation/native";
import {
  widthPercentageToDP,
  heightPercentageToDP,
} from "react-native-responsive-screen";

const LandingScreen = () => {
  const navigator = useNavigation();

  return (
    <ImageBackground
      source={require("../images/backg.png")}
      style={styles.backgroundImage}
    >
      <SafeAreaView style={styles.container}>
      <Image
          source={require("../images/logo1.png")}
          style={{
            ...styles.logo,
            width: 200,
            height: 300,
          }}
          resizeMode="contain"
        />
        <SafeAreaView style={styles.welcome}>
        <Text
          variant="headlineMedium"
          style={{
            fontSize: widthPercentageToDP("6%"), 
            color: "white",
            marginBottom: heightPercentageToDP("1%"), 
            fontWeight: "bold",
          }}
        >
          WELCOME
        </Text>
        <Text
          variant="headlineMedium"
          style={{
            fontSize: widthPercentageToDP("6%"), 
            color: "white",
            marginBottom: heightPercentageToDP("1%"), 
            fontWeight: "bold",
          }}
        >
          TO
        </Text>
        <Text
          variant="headlineMedium"
          style={{
            fontSize: widthPercentageToDP("6%"), 
            color: "#FFC42B",
            marginBottom: heightPercentageToDP("1%"), 
            fontWeight: "bold",
          }}
        >
          EVENT <Text style={{color: "white", fontWeight: "bold",}}>WISE</Text>
        </Text>
        </SafeAreaView>

        <SafeAreaView style={styles.buttonContainer}>
          <Button
            mode="contained"
            onPress={() => {
              navigator.navigate("LoginScreen");
            }}
            style={{
              backgroundColor: "black",
              borderColor: "white",
              borderWidth: "2",
              width: widthPercentageToDP("70%"),
              height: heightPercentageToDP("6%"),
            }}
            contentStyle={{
              flexDirection: "row-reverse",
              justifyContent: "center",
              alignItems: "center",
            }}
          >
            GET STARTED
          </Button>
        </SafeAreaView>
      </SafeAreaView>
    </ImageBackground>
  );
};

const styles = StyleSheet.create({
  backgroundImage: {
    flex: 1,
    resizeMode: "cover",
  },
  container: {
    flex: 1,
    justifyContent: "flex-end",
    alignItems: "center",
    paddingBottom: heightPercentageToDP("15%"), 
  },
  logo: {
    position: "absolute",
    top: heightPercentageToDP("20%"), 
  },
  welcome: {
    bottom: 200,
    flexDirection: "column",
    alignItems: "center",
  },
  buttonContainer: {
    bottom: 200,
    flexDirection: "column",
    gap: heightPercentageToDP("4%"), 
  },
});

export default LandingScreen;