import React, { useState } from "react";
import { SafeAreaView, ImageBackground, StyleSheet, Platform, KeyboardAvoidingView, ScrollView, View, TouchableOpacity } from "react-native";
import { Text, Button, TextInput, Menu, Divider, Provider as PaperProvider } from "react-native-paper";
import { useNavigation } from "@react-navigation/native";
import Toast from "react-native-root-toast";
import fetchServices from "../services/fetchServices";
import { widthPercentageToDP, heightPercentageToDP } from "react-native-responsive-screen";
import Icon from 'react-native-vector-icons/MaterialCommunityIcons';

const RegisterScreen = () => {
  const navigator = useNavigation();
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [repassword, setRepassword] = useState("");
  const [isError, setIsError] = useState(false);
  const [loading, setLoading] = useState(false);
  const [HideEntry, setHideEntry] = useState(true);
  const [role, setRole] = useState("");
  const [phoneNumber, setPhoneNumber] = useState("");
  const [visible, setVisible] = useState(false);
  const [selectedRole, setSelectedRole] = useState(null);

  const openMenu = () => setVisible(true);
  const closeMenu = () => setVisible(false);

  const handleRoleChange = (value) => {
    setSelectedRole(value);
    setRole(value);
    closeMenu();
  };

  const toggleSecureEntry = () => {
    setHideEntry(!HideEntry);
  };

  const showToast = (message = "Something went wrong") => {
    Toast.show(message, { duration: Toast.durations.LONG });
  };

  const CustomIcon = ({ name, size, color }) => {
    return <Icon name={name} size={size} color={color} />;
  };

  const handleRegistration = async () => {
    try {
      setLoading(true);

      if (username === "" || email === "" || password === "" || phoneNumber === "" || role === "") {
        showToast("Please input required data");
        setIsError(true);
        return;
      }

      if (password !== repassword) {
        showToast("Passwords do not match");
        setIsError(true);
        return;
      }

      const data = {
        username,
        email,
        password,
        role,
        phoneNumber,
      };

      const result = await fetchServices.postData(url, data);

      if (result.message != null) {
        showToast(result?.message);
      } else {
        navigator.navigate("HomeScreen");
      }
    } catch (e) {
      console.error(e.toString());
      showToast("An error occurred");
    } finally {
      setLoading(false);
    }
  };

  return (
    <ImageBackground source={require("../images/backg.png")} style={styles.backgroundImage}>
      <SafeAreaView style={styles.container}>
        <KeyboardAvoidingView
          behavior={Platform.OS === "ios" ? "padding" : null}
          style={styles.container}
          keyboardVerticalOffset={Platform.OS === "ios" ? 0 : heightPercentageToDP("10%")}
        >
          <ScrollView contentContainerStyle={styles.formContainer}>
            <Text style={styles.headerText}>REGISTER</Text>
            <PaperProvider>
              <View style={[styles.inputContainer, { backgroundColor: '#fff', borderRadius: 5, margin: 30, width: widthPercentageToDP("80%"), alignItems: "center", position: 'relative', zIndex: 1 }]}>
                <Menu
                  visible={visible}
                  onDismiss={closeMenu}
                  contentStyle={{ backgroundColor: '#fff', zIndex: 999 }}
                  anchor={
                    <View style={{ flexDirection: "row", alignItems: "center" }}>
                      <View style={[styles.menuStyle, { backgroundColor: '#FFC42B', padding: 1, borderRadius: 30, marginBottom: 5, marginTop: 5, margin: 18, zIndex: 999 }]}>
                        <Text style={{ color: "black", fontWeight: "bold", textAlign: "center", margin: 14 }}>
                          {selectedRole ?? 'Please Select Role: '}
                        </Text>
                      </View>
                      <Icon name="arrow-down-drop-circle-outline" size={30} color="black" style={{ marginLeft: 10 }} onPress={openMenu} />
                    </View>
                  }
                  style={{ position: 'absolute', zIndex: 999, top: 85, left: 95 }}
                >
                  <Menu.Item onPress={() => handleRoleChange('EVENT ORGANIZER')} title="EVENT ORGANIZER" />
                  <Divider />
                  <Menu.Item onPress={() => handleRoleChange('PARTICIPANT')} title="PARTICIPANT" />
                </Menu>
              </View>

              <View style={{ alignItems: "center" }}>
                <TextInput
                  style={styles.inputStyle}
                  mode="outlined"
                  label="Username"
                  placeholder="Enter your username"
                  error={isError}
                  value={username}
                  onChangeText={(text) => setUsername(text)}
                  theme={{
                    colors: {
                      primary: "#FFC42B",
                      text: "#000",
                      placeholder: "#FFC42B",
                      background: "#fff",
                    },
                  }}
                  left={<TextInput.Icon icon={() => <CustomIcon name="account" size={24} color="black" />} />}
                />
                <TextInput
                  style={styles.inputStyle}
                  mode="outlined"
                  label="Email"
                  placeholder="Enter your email"
                  inputMode="email"
                  value={email}
                  error={isError}
                  onChangeText={(text) => setEmail(text)}
                  theme={{
                    colors: {
                      primary: "#FFC42B",
                      text: "#000",
                      placeholder: "#FFC42B",
                      background: "#fff",
                    },
                  }}
                  left={<TextInput.Icon icon={() => <CustomIcon name="email" size={24} color="black" />} />}
                />
                <TextInput
                  style={styles.inputStyle}
                  mode="outlined"
                  label="Phone number"
                  placeholder="Enter your phone number"
                  value={phoneNumber}
                  error={isError}
                  onChangeText={(text) => setPhoneNumber(text)}
                  theme={{
                    colors: {
                      primary: "#FFC42B",
                      text: "#000",
                      placeholder: "#FFC42B",
                      background: "#fff",
                    },
                  }}
                  left={<TextInput.Icon icon={() => <CustomIcon name="phone" size={24} color="black" />} />}
                />
                <TextInput
                  mode="outlined"
                  style={styles.inputStyle}
                  label="Password"
                  placeholder="Enter your password"
                  value={password}
                  onChangeText={(text) => setPassword(text)}
                  secureTextEntry={HideEntry}
                  error={isError}
                  right={
                    <TextInput.Icon
                      onPress={toggleSecureEntry}
                      icon={!HideEntry ? "eye" : "eye-off"}
                    />
                  }
                  theme={{
                    colors: {
                      primary: "#FFC42B",
                      text: "#000",
                      placeholder: "#FFC42B",
                      background: "#fff",
                    },
                  }}
                  left={<TextInput.Icon icon={() => <CustomIcon name="lock" size={24} color="black" />} />}
                />
                <TextInput
                  mode="outlined"
                  style={styles.inputStyle}
                  label="Confirm Password"
                  placeholder="Re-enter your password"
                  value={repassword}
                  onChangeText={(text) => setRepassword(text)}
                  secureTextEntry={HideEntry}
                  error={isError}
                  right={
                    <TextInput.Icon
                      onPress={toggleSecureEntry}
                      icon={!HideEntry ? "eye" : "eye-off"}
                    />
                  }
                  theme={{
                    colors: {
                      primary: "#FFC42B",
                      text: "#000",
                      placeholder: "#FFC42B",
                      background: "#fff",
                    },
                  }}
                  left={<TextInput.Icon icon={() => <CustomIcon name="lock" size={24} color="black" />} />}
                />
                <Button
                  loading={loading}
                  disabled={loading}
                  style={styles.buttonStyle}
                  mode="contained"
                  onPress={handleRegistration}
                  labelStyle={{ color: "black", fontWeight: "bold" }}
                >
                  Create Account
                </Button>

                <SafeAreaView
                  style={{
                    flexDirection: "row",
                    justifyContent: "center",
                    alignItems: "center",
                  }}
                >
                  <Text style={{ color: "white" }}>Already have an account?</Text>
                  <Button
                    labelStyle={{ color: "#FFC42B" }}
                    loading={loading}
                    disabled={loading}
                    onPress={() => navigator.navigate("LoginScreen")}
                  >
                    Login Now
                  </Button>
                </SafeAreaView>
              </View>
            </PaperProvider>
          </ScrollView>
        </KeyboardAvoidingView>
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
    alignItems: "center",
  },
  formContainer: {
    alignItems: "center",
    paddingVertical: heightPercentageToDP("5%"),
  },
  headerText: {
    marginTop: heightPercentageToDP("5%"),
    color: "#FFC42B",
    fontWeight: "bold",
    fontSize: widthPercentageToDP("10%"),
  },
  inputContainer: {
    width: widthPercentageToDP("80%"),
    marginBottom: heightPercentageToDP("2%"),
  },
  inputStyle: {
    width: widthPercentageToDP("80%"),
    marginBottom: heightPercentageToDP("2%"),
    backgroundColor: "#fff",
  },
  buttonStyle: {
    width: widthPercentageToDP("80%"),
    height: heightPercentageToDP("6%"),
    marginBottom: heightPercentageToDP("2%"),
    backgroundColor: "#FFC42B",
  },
  menuStyle: {
    width: widthPercentageToDP("50%"),
  },
});

export default RegisterScreen;
