package com.clientindekos;

import java.util.ArrayList;

public class StringParser {
	public StringParser() {
	}

	public ArrayList<Object> Parse(String input) {
		ArrayList<Object> output = new ArrayList<Object>();
		int pointer = 0;
		String data = "";
		while (pointer <= input.length() - 1) {
			if (input.charAt(pointer) == '#') {
				output.add(data);
				data = "";
				pointer++;
			}
			if (pointer < input.length()) {
				data += input.charAt(pointer);
			}
			pointer++;
		}
		return output;
	}
}
