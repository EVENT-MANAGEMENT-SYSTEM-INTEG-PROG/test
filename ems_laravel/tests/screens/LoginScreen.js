import React from "react";
import {
  SafeAreaView,
  KeyboardAvoidingView,
  ImageBackground,
  StyleSheet,
  Platform,
  Image,
  View,
} from "react-native";
import {
  Button,
  Provider as PaperProvider,
  TextInput,
  Text,
} from "react-native-paper"
import Icon from 'react-native-vector-icons/MaterialCommunityIcons';
import { useNavigation } from "@react-navigation/native";
import {
  widthPercentageToDP,
  heightPercentageToDP,
} from "react-native-responsive-screen";
import { useState } from "react";
import Toast from "react-native-root-toast";
import fetchServices from "../services/fetchServices";

const LoginScreen = () => {
  const navigator = useNavigation();

  const [HideEntry, setHideEntry] = useState(true);
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [isError, setIsError] = useState(false);
  const [loading, setLoading] = useState(false);

  const CustomIcon = ({ name, size, color }) => {
    return <Icon name={name} size={size} color={color} />;
  };
  
  const showToast = (message = "Something went wrong") => {
    Toast.show(message, 3000);
  };

  const handleLogin = async () => {
    try {
      setLoading(!loading);

      if (username === "" || password === "") {
        showToast("Please input required data");
        setIsError(true);
        return false;
      }

      const data = {
        username,
        password,
      };

      const result = await fetchServices.postData(url, data);

      if (result.message != null) {
        showToast(result?.message);
      } else {
        navigator.navigate("HomeScreen");
      }

      if (result.message === "User Logged in Successfully") {
        navigator.navigate("HomeScreen");
      } else {
        return false;
      }
    } catch (e) {
      console.debug(e.toString());
      showToast("An error occurred");
    } finally {
      setLoading(false);
    }
  };

  const toggleSecureEntry = () => {
    setHideEntry(!HideEntry);
  };

  return (
    <PaperProvider>
      <ImageBackground
        source={require("../images/backg.png")}
        style={styles.backgroundImage}
      >
        <SafeAreaView style={styles.container}>
          <KeyboardAvoidingView
            behavior={Platform.OS === "ios" ? "padding" : null}
            style={styles.formContainer}
            keyboardVerticalOffset={
              Platform.OS === "ios" ? 0 : heightPercentageToDP("15%")
            }
          >
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
                  color: "#FFC42B",
                  marginBottom: heightPercentageToDP("1%"),
                  fontWeight: "bold",
                }}
              >
                EVENT{" "}
                <Text style={{ color: "white", fontWeight: "bold" }}>WISE</Text>
              </Text>
            </SafeAreaView>

            <SafeAreaView
              style={{ ...styles.input, gap: heightPercentageToDP("1%") }}
            >
              <TextInput
                style={styles.inputStyle}
                mode="outlined"
                label="Username"
                placeholder="Enter your username"
                inputMode="username"
                value={username}
                error={isError}
                onChangeText={(text) => {
                  setUsername(text);
                }}
                theme={{
                  colors: {
                    primary: "#FFC42B",
                    text: "#FFC42B",
                    placeholder: "#FFC42B",
                  },
                }}
                left={<TextInput.Icon icon={() => <CustomIcon name="account" size={24} color="black" />} />}
              />
              <TextInput
                mode="outlined"
                style={styles.inputStyle}
                label="Password"
                placeholder="Enter your password"
                value={password}
                onChangeText={setPassword}
                secureTextEntry={HideEntry}
                right={
                  <TextInput.Icon
                    onPress={toggleSecureEntry}
                    icon={!HideEntry ? "eye" : "eye-off"}
                  />
                }
                theme={{
                  colors: {
                    primary: "#FFC42B",
                    text: "#FFC42B",
                    placeholder: "#FFC42B",
                  },
                }}
                left={<TextInput.Icon icon={() => <CustomIcon name="lock" size={24} color="black" />} />}
              />
              <View style={styles.forgotPasswordContainer}>
                <Text style={{ color: "white" }}>Forgot Password? </Text>
                <Button
                  labelStyle={{ color: "#FFC42B" }}
                  onPress={() => {
                    navigator.navigate("AccountRecoveryScreen");
                  }}
                >
                  Recover
                </Button>
              </View>
              <Button
                style={{ ...styles.buttonStyle, backgroundColor: "#FFC42B" }}
                mode="contained-tonal"
                onPress={handleLogin}
                loading={loading}
                disabled={loading}
                labelStyle={{ color: "black", fontWeight: "bold" }}
              >
                Login
              </Button>

              <SafeAreaView
                style={{
                  flexDirection: "row",
                  justifyContent: "center",
                  alignItems: "center",
                  marginTop: -30,
                }}
              >
                <Text style={{ color: "white" }}>Don't have an account yet? </Text>
                <Button
                  mode="text"
                  labelStyle={{ color: "#FFC42B" }}
                  onPress={() => {
                    navigator.navigate("RegisterScreen");
                  }}
                  loading={loading}
                  disabled={loading}
                >
                  Register Now
                </Button>
              </SafeAreaView>
            </SafeAreaView>
          </KeyboardAvoidingView>
        </SafeAreaView>
      </ImageBackground>
    </PaperProvider>
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
  formContainer: {
    flex: 1,
    justifyContent: "flex-end",
    alignItems: "center",
    paddingBottom: heightPercentageToDP("1%"),
  },
  logo: {
    top: heightPercentageToDP("5%"),
  },
  welcome: {
    top: heightPercentageToDP("-5%"),
  },
  input: {
    marginBottom: heightPercentageToDP("12%"),
  },
  inputStyle: {
    width: widthPercentageToDP("80%"),
    marginBottom: heightPercentageToDP("2%"),
  },
  buttonStyle: {
    width: widthPercentageToDP("80%"),
    height: heightPercentageToDP("6%"),
    marginBottom: heightPercentageToDP("5%"),
    marginTop: heightPercentageToDP("-10%"),
  },
  forgotPasswordContainer: {
    flexDirection: "row",
    alignItems: "center",
    justifyContent: "center",
    marginBottom: heightPercentageToDP("10%"),
    marginTop: -15,
  },
});

export default LoginScreen;